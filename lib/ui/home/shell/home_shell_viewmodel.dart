import 'package:flutter/material.dart';

import '../../../core/services/api_service.dart';
import '../../../core/services/notification_api_service.dart';
import '../../../core/services/session_service.dart';

class HomeShellViewModel extends ChangeNotifier {
  int _currentIndex = 0;
  String _userName = "";
  String _profilePicUrl = "";
  int _unreadCount = 0;

  int get currentIndex => _currentIndex;
  String get userName => _userName;
  String get profilePicUrl => _profilePicUrl;
  int get unreadCount => _unreadCount;

  void setIndex(int index) {
    _currentIndex = index;
    notifyListeners();
  }

  void loadUser() {
    _userName = SessionService.getName();
    _profilePicUrl = SessionService.getProfilePic();
    notifyListeners();
    fetchProfilePhoto();
    fetchUnreadCount();
  }

  Future<void> fetchProfilePhoto() async {
    try {
      final userId = SessionService.getUserId();
      if (userId.isEmpty) return;

      final response = await ApiService.post(
        endpoint: "apiGetProfilePhoto.php",
        body: {"user_id": userId},
      );

      if (response['status'] == 'success') {
        final url = response['profile_pic'] ?? "";
        if (url.isNotEmpty && url != _profilePicUrl) {
          _profilePicUrl = url;
          SessionService.saveProfilePic(url);
          notifyListeners();
        }
      }
    } catch (e) {
      debugPrint("Error fetching profile photo: $e");
    }
  }

  Future<void> fetchUnreadCount() async {
    try {
      final userId = SessionService.getUserId();
      if (userId.isEmpty) return;

      final notifications = await NotificationApiService.getUnreadNotifications(userId);
      _unreadCount = notifications.length;
      notifyListeners();
    } catch (e) {
      debugPrint("Error fetching unread count: $e");
    }
  }

  void reset() {
    _userName = "";
    _currentIndex = 0;
    _profilePicUrl = "";
    notifyListeners();
  }
}
