import 'package:flutter/material.dart';

import '../../../core/services/session_service.dart';

class HomeShellViewModel extends ChangeNotifier {
  int _currentIndex = 1;
  String _userName = "";

  int get currentIndex => _currentIndex;
  String get userName => _userName;

  void setIndex(int index) {
    _currentIndex = index;
    notifyListeners();
  }

  void loadUser() {
    _userName = SessionService.getName();
    notifyListeners();
  }

  void reset() {
    _userName = "";
    _currentIndex = 1;
    notifyListeners();
  }
}
