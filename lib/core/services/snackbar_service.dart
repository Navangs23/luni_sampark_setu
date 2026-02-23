import 'package:flutter/material.dart';
import 'package:luni_sampark_setu/core/theme/app_colors.dart';

enum SnackbarType { success, error, warning, info }

class SnackbarService {
  static final GlobalKey<ScaffoldMessengerState> messengerKey =
      GlobalKey<ScaffoldMessengerState>();

  static void show(String message, {SnackbarType type = SnackbarType.info}) {
    final messenger = messengerKey.currentState;
    final context = messengerKey.currentContext;

    if (messenger == null || context == null) return;

    messenger.clearSnackBars();

    messenger.showSnackBar(
      SnackBar(
        behavior: SnackBarBehavior.floating,
        duration: const Duration(seconds: 3),
        backgroundColor: _getColor(type),
        showCloseIcon: true,
        closeIconColor: Colors.white,
        content: Row(
          children: [
            Icon(_getIcon(type), color: Colors.white, size: 20),
            const SizedBox(width: 8),
            Expanded(
              child: Text(
                message,
                style: const TextStyle(
                  color: Colors.white,
                  fontWeight: FontWeight.w500,
                ),
              ),
            ),
          ],
        ),
        shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(12)),
      ),
    );
  }

  static Color _getColor(SnackbarType type) {
    switch (type) {
      case SnackbarType.success:
        return AppColors.success;
      case SnackbarType.error:
        return Colors.red.shade600;
      case SnackbarType.warning:
        return AppColors.warning;
      case SnackbarType.info:
        return AppColors.secondary;
    }
  }

  static IconData _getIcon(SnackbarType type) {
    switch (type) {
      case SnackbarType.success:
        return Icons.check_circle;
      case SnackbarType.error:
        return Icons.error;
      case SnackbarType.warning:
        return Icons.warning;
      case SnackbarType.info:
        return Icons.info;
    }
  }
}
