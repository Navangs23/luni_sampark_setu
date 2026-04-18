import 'package:flutter/material.dart';
import '../../../core/models/notification_model.dart';
import '../../../core/services/notification_api_service.dart';
import '../../../core/services/session_service.dart';

class NotificationsViewModel extends ChangeNotifier {
  List<NotificationModel> _notifications = [];
  bool _isLoading = false;

  List<NotificationModel> get notifications => _notifications;
  bool get isLoading => _isLoading;

  Future<void> fetchNotifications() async {
    _isLoading = true;
    notifyListeners();

    try {
      final userId = SessionService.getUserId();
      if (userId.isNotEmpty) {
        _notifications = await NotificationApiService.getUnreadNotifications(userId);
      }
    } catch (e) {
      debugPrint("Error in NotificationsViewModel.fetchNotifications: $e");
    } finally {
      _isLoading = false;
      notifyListeners();
    }
  }

  Future<void> markAsRead(String notificationId) async {
    try {
      final userId = SessionService.getUserId();
      if (userId.isNotEmpty) {
        final success = await NotificationApiService.markAsRead(userId, notificationId);
        if (success) {
          _notifications.removeWhere((n) => n.id == notificationId);
          notifyListeners();
        }
      }
    } catch (e) {
      debugPrint("Error in NotificationsViewModel.markAsRead: $e");
    }
  }
}
