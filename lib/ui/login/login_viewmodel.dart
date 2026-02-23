import 'package:flutter/material.dart';

import '../../core/services/api_service.dart';
import '../../core/services/navigation_service.dart';
import '../../core/services/session_service.dart';
import '../../core/services/snackbar_service.dart';
import '../home/shell/home_shell_view.dart';

class LoginViewModel extends ChangeNotifier {
  String _mobile = '';
  String _otp = '';

  bool _showOtpField = false;
  bool _isLoading = false;

  bool get showOtpField => _showOtpField;
  bool get isLoading => _isLoading;

  void setMobile(String value) {
    _mobile = value.trim();
  }

  void setOtp(String value) {
    _otp = value.trim();
  }

  void reset() {
    _mobile = '';
    _otp = '';
    _showOtpField = false;
    _isLoading = false;
    notifyListeners();
  }

  void changeMobile() {
    _showOtpField = false;
    _otp = '';
    notifyListeners();
  }

  Future<void> sendOtp() async {
    if (_mobile.length < 10) {
      SnackbarService.show(
        'Please enter a valid mobile number',
        type: SnackbarType.error,
      );
      return;
    }

    _isLoading = true;
    notifyListeners();

    try {
      final response = await ApiService.post(
        endpoint: "sendOTPToUser.php",
        body: {
          "username": _mobile,
        },
      );

      if (response["success"] == 1) {
        _showOtpField = true;
        SnackbarService.show(
          response["message"],
          type: SnackbarType.success,
        );
      } else {
        SnackbarService.show(
          response["message"] ?? "Something went wrong",
          type: SnackbarType.error,
        );
      }
    } catch (e) {
      SnackbarService.show(
        "Network error. Please try again.",
        type: SnackbarType.error,
      );
    } finally {
      _isLoading = false;
      notifyListeners();
    }
  }


  Future<void> login() async {
    if (_otp.length < 6) {
      SnackbarService.show(
        'Please enter valid OTP',
        type: SnackbarType.error,
      );
      return;
    }

    _isLoading = true;
    notifyListeners();

    try {
      final response = await ApiService.post(
        endpoint: "checkLogin.php",
        body: {
          "username": _mobile,
          "password": _otp,
        },
      );

      if (response["success"] == 1) {
        // 🔥 Save session locally
         SessionService.saveUser(
          userId: response["user_id"],
          familyId: response["family_id"],
          name: response["name"],
           mobile: _mobile,
        );

        SnackbarService.show(
          response["message"],
          type: SnackbarType.success,
        );

        reset();

        NavigationService.pushReplacement(HomeShellView());
      } else {
        SnackbarService.show(
          response["message"] ?? "Invalid OTP",
          type: SnackbarType.error,
        );
      }
    } catch (e) {
      SnackbarService.show(
        "Network error. Please try again.",
        type: SnackbarType.error,
      );
    } finally {
      _isLoading = false;
      notifyListeners();
    }
  }

}
