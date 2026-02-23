import 'package:flutter/material.dart';
import 'package:provider/provider.dart';

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
  late Animation<Offset> _adSlide;
  late Animation<double> _adFade;

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

    _adSlide = Tween<Offset>(begin: const Offset(0, 0.15), end: Offset.zero)
        .animate(
          CurvedAnimation(
            parent: _controller,
            curve: const Interval(0.3, 1.0, curve: Curves.easeOut),
          ),
        );

    _adFade = Tween<double>(begin: 0.0, end: 1.0).animate(
      CurvedAnimation(
        parent: _controller,
        curve: const Interval(0.3, 1.0, curve: Curves.easeIn),
      ),
    );

    // Start animation
    _controller.forward();

    // Navigate after delay
    Future.delayed(const Duration(milliseconds: 2500), () async {
      if (!mounted) return;

      final isLoggedIn = await SessionService.isLoggedIn();

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
    });

  }

  @override
  void dispose() {
    _controller.dispose();
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    final vm = context.watch<SplashViewModel>();
    final theme = Theme.of(context);

    return Scaffold(
      backgroundColor: theme.colorScheme.surface,
      body: SafeArea(
        child: Column(
          children: [
            // 🔹 Center Logo (Animated)
            Expanded(
              child: Center(
                child: FadeTransition(
                  opacity: _logoFade,
                  child: ScaleTransition(
                    scale: _logoScale,
                    child: Padding(
                      padding: const EdgeInsets.all(30),
                      child: Image.asset(
                        'assets/images/app_logo.png',
                        width: 224,
                        fit: BoxFit.contain,
                      ),
                    ),
                  ),
                ),
              ),
            ),

            // 🔹 Bottom Ad (Animated)
            Padding(
              padding: const EdgeInsets.fromLTRB(30, 0, 30, 10),
              child: SlideTransition(
                position: _adSlide,
                child: FadeTransition(
                  opacity: _adFade,
                  child: GestureDetector(
                    onTap: vm.openAd1,
                    child: ClipRRect(
                      borderRadius: BorderRadius.circular(16),
                      child: Image.asset(
                        'assets/banners/splash_banner.jpeg',
                        fit: BoxFit.contain,
                        width: double.infinity,
                        height: 270,
                        /*loadingBuilder: (context, child, progress) {
                          if (progress == null) return child;
                          return const Center(
                            child: CircularProgressIndicator(),
                          );
                        },*/
                        errorBuilder: (context, error, stackTrace) {
                          return Image.asset(
                            'assets/banners/splash_banner.jpeg',
                            fit: BoxFit.cover,
                          );
                        },
                      ),
                    ),
                  ),
                ),
              ),
            ),
          ],
        ),
      ),
    );
  }
}
