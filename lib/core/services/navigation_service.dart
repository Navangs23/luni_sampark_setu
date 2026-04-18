import 'package:flutter/material.dart';

class NavigationService {
  static final GlobalKey<NavigatorState> navigatorKey =
      GlobalKey<NavigatorState>();

  static Future<T?> push<T>(Widget page) async {
    return await navigatorKey.currentState?.push<T>(_buildRoute<T>(page));
  }

  static Future<T?> pushReplacement<T, TO>(Widget page) async {
    return await navigatorKey.currentState
        ?.pushReplacement<T, TO>(_buildRoute<T>(page));
  }

  static Future<void> pushAndRemoveUntil(Widget page) async {
    await navigatorKey.currentState?.pushAndRemoveUntil(
      _buildRoute(page),
      (route) => false,
    );
  }

  static void pop() {
    navigatorKey.currentState?.pop();
  }

  static Route<T> _buildRoute<T>(Widget page) {
    return PageRouteBuilder<T>(
      transitionDuration: const Duration(milliseconds: 250),
      reverseTransitionDuration: const Duration(milliseconds: 200),
      pageBuilder: (context, animation, secondaryAnimation) => page,
      transitionsBuilder: (context, animation, secondaryAnimation, child) {
        return FadeTransition(
          opacity: CurvedAnimation(parent: animation, curve: Curves.easeInOut),
          child: child,
        );
      },
    );
  }
}
