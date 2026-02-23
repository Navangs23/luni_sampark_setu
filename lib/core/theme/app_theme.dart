import 'package:flutter/material.dart';

import 'app_colors.dart';

class AppTheme {
  AppTheme._();

  // 🌞 LIGHT THEME
  static ThemeData lightTheme = ThemeData(
    useMaterial3: true,
    brightness: Brightness.light,

    colorScheme: ColorScheme.light(
      primary: AppColors.primary,
      secondary: AppColors.secondary,
      tertiary: AppColors.warning,
      background: AppColors.lightBackground,
      surface: AppColors.lightSurface,
      error: Colors.red,
      onPrimary: Colors.white,
      onSecondary: Colors.white,
      onBackground: AppColors.lightText,
      onSurface: AppColors.lightText,
    ),

    scaffoldBackgroundColor: AppColors.lightBackground,

    appBarTheme: const AppBarTheme(
      elevation: 0,
      backgroundColor: AppColors.lightSurface,
      foregroundColor: AppColors.primary,
    ),

    cardTheme: CardThemeData(
      color: AppColors.lightSurface,
      elevation: 2,
      shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(14)),
    ),

    textTheme: const TextTheme(
      titleLarge: TextStyle(fontWeight: FontWeight.bold),
      bodyMedium: TextStyle(color: AppColors.lightText),
      bodySmall: TextStyle(color: AppColors.lightSubText),
    ),

    elevatedButtonTheme: ElevatedButtonThemeData(
      style: ElevatedButton.styleFrom(
        backgroundColor: AppColors.primary,
        foregroundColor: Colors.white,
        shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(12)),
      ),
    ),
    inputDecorationTheme: InputDecorationTheme(
      filled: true,
      fillColor: Colors.transparent,
      border: OutlineInputBorder(borderRadius: BorderRadius.circular(12)),
      enabledBorder: OutlineInputBorder(
        borderRadius: BorderRadius.circular(12),
        borderSide: BorderSide(color: Colors.grey.shade300),
      ),
      focusedBorder: OutlineInputBorder(
        borderRadius: BorderRadius.circular(12),
        borderSide: BorderSide(color: AppColors.primary),
      ),
      contentPadding: const EdgeInsets.symmetric(horizontal: 12, vertical: 14),
    ),
  );

  // 🌙 DARK THEME
  static ThemeData darkTheme = ThemeData(
    useMaterial3: true,
    brightness: Brightness.dark,

    colorScheme: ColorScheme.dark(
      primary: AppColors.primary,
      secondary: AppColors.secondary,
      tertiary: AppColors.warning,
      background: AppColors.darkBackground,
      surface: AppColors.darkSurface,
      error: Colors.redAccent,
      onPrimary: Colors.white,
      onSecondary: Colors.white,
      onBackground: AppColors.darkText,
      onSurface: AppColors.darkText,
    ),

    scaffoldBackgroundColor: AppColors.darkBackground,

    appBarTheme: const AppBarTheme(
      elevation: 0,
      backgroundColor: AppColors.darkSurface,
      foregroundColor: Colors.white,
    ),

    cardTheme: CardThemeData(
      color: AppColors.darkSurface,
      elevation: 1,
      shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(14)),
    ),

    textTheme: const TextTheme(
      bodyMedium: TextStyle(color: AppColors.darkText),
      bodySmall: TextStyle(color: AppColors.darkSubText),
    ),

    elevatedButtonTheme: ElevatedButtonThemeData(
      style: ElevatedButton.styleFrom(
        backgroundColor: AppColors.primary,
        foregroundColor: Colors.white,
        shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(12)),
      ),
    ),
    inputDecorationTheme: InputDecorationTheme(
      filled: true,
      fillColor: Colors.transparent,
      border: OutlineInputBorder(borderRadius: BorderRadius.circular(12)),
      enabledBorder: OutlineInputBorder(
        borderRadius: BorderRadius.circular(12),
        borderSide: BorderSide(color: Colors.grey.shade300),
      ),
      focusedBorder: OutlineInputBorder(
        borderRadius: BorderRadius.circular(12),
        borderSide: BorderSide(color: AppColors.primary),
      ),
      contentPadding: const EdgeInsets.symmetric(horizontal: 12, vertical: 14),
    ),
  );
}
