import 'package:flutter/material.dart';

import '../../core/services/api_service.dart';
import '../../core/services/navigation_service.dart';
import '../../core/services/session_service.dart';
import '../../core/services/snackbar_service.dart';
import '../home/shell/home_shell_view.dart';

class LoginViewModel extends ChangeNotifier {
  String _mobile = '';
  String _password = '';

  bool _isLoading = false;

  bool get isLoading => _isLoading;

  void setMobile(String value) {
    _mobile = value.trim();
  }

  void setPassword(String value) {
    _password = value.trim();
  }

  void reset() {
    _mobile = '';
    _password = '';
    _isLoading = false;
    notifyListeners();
  }

  Future<void> login() async {
    if (_mobile.isEmpty || _mobile.length < 10) {
      SnackbarService.show("Enter valid mobile number");
      return;
    }

    if (_password.isEmpty) {
      SnackbarService.show("Enter password");
      return;
    }

    _isLoading = true;
    notifyListeners();

    try {
      final response = await ApiService.post(
        endpoint: "apiCheckLogin.php",
        body: {"username": _mobile, "password": _password},
      );

      if (response["success"] == 1) {
        SessionService.saveUser(
          userId: response["user_id"],
          familyId: response["family_id"],
          name: response["name"],
          mobile: _mobile,
        );

        NavigationService.pushReplacement(const HomeShellView());
      } else {
        SnackbarService.show(response["message"] ?? "Login failed");
      }
    } catch (e) {
      print(e);
      SnackbarService.show("Something went wrong");
    }

    _isLoading = false;
    notifyListeners();
  }
}
