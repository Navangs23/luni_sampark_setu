import 'package:flutter/material.dart';
import 'package:provider/provider.dart';

import 'package:luni_sampark_setu/core/services/notification_service.dart';
import '../../core/services/session_service.dart';
import '../home/shell/home_shell_view.dart';
import '../login/login_view.dart';
import 'splash_viewmodel.dart';

class SplashView extends StatefulWidget {
  const SplashView({super.key});

  @override
  State<SplashView> createState() => _SplashViewState();
}

class _SplashViewState extends State<SplashView>
    with SingleTickerProviderStateMixin {
  late AnimationController _controller;
  late Animation<double> _logoScale;
  late Animation<double> _logoFade;
  late Animation<Offset> _bannerSlide;
  late Animation<double> _bannerFade;

  bool _isInitDone = false;

  @override
  void initState() {
    super.initState();

    _controller = AnimationController(
      vsync: this,
      duration: const Duration(milliseconds: 900),
    );

    _logoScale = Tween<double>(
      begin: 1.0,
      end: 1.05,
    ).animate(CurvedAnimation(parent: _controller, curve: Curves.easeOut));

    _logoFade = Tween<double>(
      begin: 0.0,
      end: 1.0,
    ).animate(CurvedAnimation(parent: _controller, curve: Curves.easeIn));

    _bannerSlide = Tween<Offset>(begin: const Offset(0, 0.2), end: Offset.zero)
        .animate(
          CurvedAnimation(
            parent: _controller,
            curve: const Interval(0.3, 1.0, curve: Curves.easeOut),
          ),
        );

    _bannerFade = Tween<double>(begin: 0.0, end: 1.0).animate(
      CurvedAnimation(
        parent: _controller,
        curve: const Interval(0.3, 1.0, curve: Curves.easeIn),
      ),
    );

    _controller.forward();
    _initApp();
  }

  Future<void> _initApp() async {
    final startTime = DateTime.now();
    debugPrint("[STARTUP 00] _initApp START at ${DateTime.now().toIso8601String()}");

    try {
      debugPrint("[STARTUP 01] initFirebase START at ${DateTime.now().toIso8601String()}");
      final f1 = DateTime.now();
      await NotificationService.initFirebase();
      debugPrint("[STARTUP 01] initFirebase END - ${DateTime.now().difference(f1).inMilliseconds}ms");

      debugPrint("[STARTUP 02] NotificationService.init START at ${DateTime.now().toIso8601String()}");
      final f2 = DateTime.now();
      await NotificationService.init();
      debugPrint("[STARTUP 02] NotificationService.init END - ${DateTime.now().difference(f2).inMilliseconds}ms");
    } catch (e, stack) {
      debugPrint("[STARTUP ERROR] Exception caught in SplashView._initApp(): $e");
      debugPrint(stack.toString());
    }

    if (mounted) {
      setState(() {
        _isInitDone = true;
      });
    }

    final elapsed = DateTime.now().difference(startTime).inMilliseconds;
    debugPrint("[STARTUP 03] Session check. Elapsed: ${elapsed}ms");
    if (elapsed < 2500) {
      debugPrint("[STARTUP 03] Enforcing minimum splash delay of ${2500 - elapsed}ms");
      await Future.delayed(Duration(milliseconds: 2500 - elapsed));
    }

    if (!mounted) {
      debugPrint("[STARTUP 03] SplashView not mounted after delay. Aborting navigation.");
      return;
    }

    debugPrint("[STARTUP 03] SessionService.isLoggedIn START");
    final f3 = DateTime.now();
    final isLoggedIn = await SessionService.isLoggedIn();
    debugPrint("[STARTUP 03] SessionService.isLoggedIn END - ${DateTime.now().difference(f3).inMilliseconds}ms, isLoggedIn: $isLoggedIn");

    debugPrint("[STARTUP 04] Navigation START");
    if (isLoggedIn) {
      Navigator.pushReplacement(
        context,
        MaterialPageRoute(builder: (_) => HomeShellView()),
      );
    } else {
      Navigator.pushReplacement(
        context,
        MaterialPageRoute(builder: (_) => LoginView()),
      );
    }
  }

  @override
  void dispose() {
    _controller.dispose();
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    final theme = Theme.of(context);

    return Scaffold(
      backgroundColor: theme.colorScheme.surface,
      body: SafeArea(
        child: Stack(
          children: [
            /// 🔥 CENTER CONTENT (LOGO + BANNER)
            Center(
              child: Column(
                mainAxisSize: MainAxisSize.min,
                children: [
                  /// 🔹 LOGO
                  FadeTransition(
                    opacity: _logoFade,
                    child: ScaleTransition(
                      scale: _logoScale,
                      child: Image.asset(
                        'assets/images/app_logo.png',
                        width: 220,
                        fit: BoxFit.contain,
                      ),
                    ),
                  ),

                  const SizedBox(height: 24),

                  /// 🔹 BANNER
                  SlideTransition(
                    position: _bannerSlide,
                    child: FadeTransition(
                      opacity: _bannerFade,
                      child: ClipRRect(
                        borderRadius: BorderRadius.circular(16),
                        child: Image.asset(
                          'assets/banners/splash_banner.jpeg',
                          width: MediaQuery.of(context).size.width * 0.85,
                          fit: BoxFit.cover,
                        ),
                      ),
                    ),
                  ),
                ],
              ),
            ),

            /// 🔹 LOADER (BOTTOM)
            if (!_isInitDone)
              Positioned(
                bottom: 30,
                left: 0,
                right: 0,
                child: Column(
                  children: const [
                    SizedBox(
                      width: 24,
                      height: 24,
                      child: CircularProgressIndicator(
                        strokeWidth: 2,
                        valueColor: AlwaysStoppedAnimation<Color>(
                          Colors.orange,
                        ),
                      ),
                    ),
                    SizedBox(height: 8),
                    Text(
                      "Initializing...",
                      style: TextStyle(
                        fontSize: 12,
                        color: Colors.grey,
                        fontWeight: FontWeight.w500,
                      ),
                    ),
                  ],
                ),
              ),
          ],
        ),
      ),
    );
  }
}
