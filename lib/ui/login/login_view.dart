import 'package:flutter/material.dart';
import 'package:luni_sampark_setu/core/theme/app_colors.dart';
import 'package:provider/provider.dart';

import '../common/widgets/app_text_field.dart';
import 'login_viewmodel.dart';

class LoginView extends StatefulWidget {
  LoginView({super.key});

  @override
  State<LoginView> createState() => _LoginViewState();
}

class _LoginViewState extends State<LoginView> {
  bool hidePassword = true;
  @override
  Widget build(BuildContext context) {
    final vm = context.watch<LoginViewModel>();
    final theme = Theme.of(context);

    return Scaffold(
      body: Stack(
        children: [
          // 🔹 Gradient Background
          Container(
            decoration: BoxDecoration(
              gradient: LinearGradient(
                begin: Alignment.topLeft,
                end: Alignment.bottomRight,
                colors: [
                  theme.colorScheme.primary,
                  theme.colorScheme.secondary,
                ],
              ),
            ),
          ),

          // 🔹 Decorative Pattern (Circles)
          Positioned(
            top: -100,
            left: -80,
            child: _PatternCircle(
              size: 220,
              color: Colors.white.withOpacity(0.12),
            ),
          ),
          Positioned(
            bottom: -120,
            right: -100,
            child: _PatternCircle(
              size: 260,
              color: Colors.white.withOpacity(0.08),
            ),
          ),
          Positioned(
            top: 120,
            right: -60,
            child: _PatternCircle(
              size: 140,
              color: Colors.white.withOpacity(0.1),
            ),
          ),
          Positioned(
            top: 40,
            left: 60,
            child: _PatternCircle(
              size: 90,
              color: Colors.white.withOpacity(0.06),
            ),
          ),
          Positioned(
            top: 220,
            left: -40,
            child: _PatternCircle(
              size: 120,
              color: Colors.white.withOpacity(0.05),
            ),
          ),
          Positioned(
            bottom: 180,
            right: 40,
            child: _PatternCircle(
              size: 100,
              color: Colors.white.withOpacity(0.06),
            ),
          ),
          Positioned(
            bottom: 40,
            left: 80,
            child: _PatternCircle(
              size: 140,
              color: Colors.white.withOpacity(0.04),
            ),
          ),

          // 🔹 Login Card
          SafeArea(
            child: Center(
              child: SingleChildScrollView(
                padding: const EdgeInsets.all(16),
                child: Container(
                  decoration: BoxDecoration(
                    color: theme.colorScheme.onPrimary,
                    borderRadius: BorderRadius.circular(20),
                    boxShadow: [
                      BoxShadow(
                        color: Colors.black.withOpacity(0.2),
                        blurRadius: 20,
                        offset: const Offset(0, 12),
                      ),
                    ],
                  ),
                  padding: const EdgeInsets.all(20),
                  child: Column(
                    mainAxisSize: MainAxisSize.min,
                    children: [
                      const SizedBox(height: 12),

                      // 🔹 Logo
                      SizedBox(
                        height: 90,
                        child: Image.asset(
                          'assets/images/app_logo.png',
                          fit: BoxFit.contain,
                        ),
                      ),

                      const SizedBox(height: 24),

                      // 🔹 Title
                      Text(
                        'Login',
                        style: theme.textTheme.headlineSmall?.copyWith(
                          fontWeight: FontWeight.bold,
                          color: theme.colorScheme.secondary,
                        ),
                      ),

                      const SizedBox(height: 6),

                      // 🔹 Subtitle
                      Text(
                        'Enter your mobile number and password',
                        style: theme.textTheme.bodySmall,
                        textAlign: TextAlign.center,
                      ),

                      const SizedBox(height: 32),

                      // 🔹 Mobile Number
                      AppTextField(
                        label: 'Mobile Number',
                        keyboardType: TextInputType.number,
                        maxLength: 10,
                        onChanged: vm.setMobile,
                      ),

                      const SizedBox(height: 12),

                      // 🔹 Password Field
                      AppTextField(
                        label: 'Password',
                        obscureText: hidePassword,
                        onChanged: vm.setPassword,
                        suffixIcon: IconButton(
                          icon: Icon(
                            hidePassword
                                ? Icons.visibility_off
                                : Icons.visibility,
                            color: AppColors.lightSubText,
                          ),
                          onPressed: () {
                            setState(() {
                              hidePassword = !hidePassword;
                            });
                          },
                        ),
                      ),

                      const SizedBox(height: 24),

                      // 🔹 Login Button
                      SizedBox(
                        width: double.infinity,
                        height: 48,
                        child: ElevatedButton(
                          style: ElevatedButton.styleFrom(
                            backgroundColor: theme.colorScheme.primary,
                            shape: RoundedRectangleBorder(
                              borderRadius: BorderRadius.circular(12),
                            ),
                          ),
                          onPressed: vm.isLoading ? null : vm.login,
                          child: AnimatedSwitcher(
                            duration: const Duration(milliseconds: 200),
                            child: vm.isLoading
                                ? const SizedBox(
                                    key: ValueKey('loader'),
                                    width: 22,
                                    height: 22,
                                    child: CircularProgressIndicator(
                                      strokeWidth: 2.5,
                                      color: Colors.white,
                                    ),
                                  )
                                : const Text(
                                    'Login',
                                    key: ValueKey('text'),
                                    style: TextStyle(
                                      fontWeight: FontWeight.bold,
                                    ),
                                  ),
                          ),
                        ),
                      ),

                      const SizedBox(height: 12),
                    ],
                  ),
                ),
              ),
            ),
          ),
        ],
      ),
    );
  }
}

/// 🔹 Decorative Circle Widget
class _PatternCircle extends StatelessWidget {
  final double size;
  final Color color;

  const _PatternCircle({required this.size, required this.color});

  @override
  Widget build(BuildContext context) {
    return Container(
      width: size,
      height: size,
      decoration: BoxDecoration(shape: BoxShape.circle, color: color),
    );
  }
}
