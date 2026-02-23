import 'package:flutter/material.dart';

class AppColors {
  AppColors._(); // no instances

  // 🔹 Brand Colors
  static const Color primary = Color(0xFFD81C5B);
  static const Color secondary = Color(0xFF269CD8);
  static const Color success = Color(0xFF4BB649);
  static const Color warning = Color(0xFFF6911D);

  // 🔹 Light Theme
  static const Color lightBackground = Color(0xFFF5F5F5);
  static const Color lightSurface = Colors.white;
  static const Color lightText = Color(0xFF1E1E1E);
  static const Color lightSubText = Color(0xFF6E6E6E);

  // 🔹 Dark Theme
  static const Color darkBackground = Color(0xFF121212);
  static const Color darkSurface = Color(0xFF1E1E1E);
  static const Color darkText = Color(0xFFEAEAEA);
  static const Color darkSubText = Color(0xFFB0B0B0);

  // 🔹 Common
  static const Color divider = Color(0xFFE0E0E0);

  static const List<Color> iconColors = [primary, secondary, success, warning];
}
