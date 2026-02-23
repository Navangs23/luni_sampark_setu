import 'package:flutter/material.dart';

class SplashViewModel extends ChangeNotifier {
  void openAd1() {
    debugPrint('Splash Ad 1 clicked');
  }

  void openAd2() {
    debugPrint('Splash Ad 2 clicked');
  }

  Future<void> startApp(BuildContext context) async {
    await Future.delayed(const Duration(seconds: 2));

    // TODO: Decide navigation
    // Navigator.pushReplacement(...)
  }
}
