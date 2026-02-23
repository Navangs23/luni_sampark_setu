import 'package:flutter/material.dart';

class NavigationService {
  static final GlobalKey<NavigatorState> navigatorKey =
      GlobalKey<NavigatorState>();

  static void push(Widget page) {
    navigatorKey.currentState?.push(_buildRoute(page));
  }

  static void pushReplacement(Widget page) {
    navigatorKey.currentState?.pushReplacement(_buildRoute(page));
  }

  static void pop() {
    navigatorKey.currentState?.pop();
  }

  static PageRoute _buildRoute(Widget page) {
    return PageRouteBuilder(
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
