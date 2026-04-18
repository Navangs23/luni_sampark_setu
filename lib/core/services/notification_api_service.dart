import 'package:flutter/material.dart';
import '../models/notification_model.dart';
import 'api_service.dart';

class NotificationApiService {
  static Future<List<NotificationModel>> getUnreadNotifications(String userId) async {
    try {
      final response = await ApiService.post(
        endpoint: "apiGetNotifications.php",
        body: {"user_id": userId},
      );

      if (response['success'] == 1) {
        final List<dynamic> data = response['notifications'] ?? [];
        return data.map((json) => NotificationModel.fromJson(json)).toList();
      } else {
        return [];
      }
    } catch (e) {
      debugPrint("Error fetching notifications: $e");
      return [];
    }
  }

  static Future<bool> markAsRead(String userId, String notificationId) async {
    try {
      debugPrint("API: Marking notification as read - User: $userId, NotificationId: $notificationId");
      final response = await ApiService.post(
        endpoint: "apiReadNotification.php",
        body: {
          "user_id": userId,
          "notification_id": notificationId,
        },
      );

      final isSuccess = response['success'] == 1;
      debugPrint("API Result: ${isSuccess ? 'Success' : 'Failed'} for notification $notificationId");
      return isSuccess;
    } catch (e) {
      debugPrint("Error marking notification as read: $e");
      return false;
    }
  }
}
