import 'package:flutter/material.dart';
import 'package:luni_sampark_setu/ui/home/shell/home_shell_viewmodel.dart';
import 'package:provider/provider.dart';

import '../../../core/services/api_service.dart';
import '../../../core/services/navigation_service.dart';
import '../../../core/services/session_service.dart';
import '../../../core/services/snackbar_service.dart';
import '../../common/widgets/app_text_field.dart';
import '../../login/login_view.dart';

class ChangePasswordView extends StatefulWidget {
  const ChangePasswordView({super.key});

  @override
  State<ChangePasswordView> createState() => _ChangePasswordViewState();
}

class _ChangePasswordViewState extends State<ChangePasswordView> {
  String currentPassword = '';
  String newPassword = '';
  String confirmPassword = '';

  bool isLoading = false;
  bool showCurrentPassword = false;
  bool showNewPassword = false;
  bool showConfirmPassword = false;

  Future<void> changePassword() async {
    if (currentPassword.isEmpty ||
        newPassword.isEmpty ||
        confirmPassword.isEmpty) {
      SnackbarService.show("Please fill all fields");
      return;
    }

    if (newPassword.length < 4) {
      SnackbarService.show("Password must be at least 4 characters long");
      return;
    }

    if (newPassword != confirmPassword) {
      SnackbarService.show("New passwords do not match");
      return;
    }

    if (currentPassword == newPassword) {
      SnackbarService.show("New password cannot be same as current password");
      return;
    }

    setState(() {
      isLoading = true;
    });

    try {
      final response = await ApiService.post(
        endpoint: "apiChangePassword.php",
        body: {
          "user_id": SessionService.getUserId(),
          "current_password": currentPassword,
          "new_password": newPassword,
        },
      );

      if (response["success"] == 1) {
        SnackbarService.show(
          response["message"] ?? "Password changed successfully",
          type: SnackbarType.success,
        );

        /// 🔹 Logout user after password change
        SessionService.logout();
        await SessionService.init();
        if (mounted) {
          context.read<HomeShellViewModel>().reset();
        }
        NavigationService.pushAndRemoveUntil(LoginView());
      } else {
        SnackbarService.show(
          response["message"] ?? "Failed to change password",
        );
      }
    } catch (e) {
      SnackbarService.show("Something went wrong");
    }

    setState(() {
      isLoading = false;
    });
  }

  @override
  Widget build(BuildContext context) {
    final theme = Theme.of(context);

    return Scaffold(
      appBar: AppBar(title: const Text("Change Password")),
      body: Padding(
        padding: const EdgeInsets.all(16),
        child: Column(
          children: [
            AppTextField(
              label: "Current Password",
              obscureText: !showCurrentPassword,
              onChanged: (v) => currentPassword = v,
              suffixIcon: IconButton(
                icon: Icon(
                  showCurrentPassword ? Icons.visibility : Icons.visibility_off,
                  color: theme.colorScheme.secondary.withOpacity(0.7),
                ),
                onPressed: () {
                  setState(() {
                    showCurrentPassword = !showCurrentPassword;
                  });
                },
              ),
            ),
            const SizedBox(height: 16),
            AppTextField(
              label: "New Password",
              obscureText: !showNewPassword,
              onChanged: (v) => newPassword = v,
              suffixIcon: IconButton(
                icon: Icon(
                  showNewPassword ? Icons.visibility : Icons.visibility_off,
                  color: theme.colorScheme.secondary.withOpacity(0.7),
                ),
                onPressed: () {
                  setState(() {
                    showNewPassword = !showNewPassword;
                  });
                },
              ),
            ),
            const SizedBox(height: 16),
            AppTextField(
              label: "Confirm New Password",
              obscureText: !showConfirmPassword,
              onChanged: (v) => confirmPassword = v,
              suffixIcon: IconButton(
                icon: Icon(
                  showConfirmPassword ? Icons.visibility : Icons.visibility_off,
                  color: theme.colorScheme.secondary.withOpacity(0.7),
                ),
                onPressed: () {
                  setState(() {
                    showConfirmPassword = !showConfirmPassword;
                  });
                },
              ),
            ),
            const SizedBox(height: 24),
            SizedBox(
              width: double.infinity,
              height: 48,
              child: ElevatedButton(
                onPressed: isLoading ? null : changePassword,
                child: isLoading
                    ? const CircularProgressIndicator(color: Colors.white)
                    : const Text("Change Password"),
              ),
            ),
          ],
        ),
      ),
    );
  }
}
