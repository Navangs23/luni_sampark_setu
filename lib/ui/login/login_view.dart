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

  final FocusNode _otpFocusNode = FocusNode();

  @override
  void dispose() {
    _otpFocusNode.dispose();
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    final vm = context.watch<LoginViewModel>();
    final theme = Theme.of(context);
    if (vm.showOtpField) {
      WidgetsBinding.instance.addPostFrameCallback((_) {
        if (!_otpFocusNode.hasFocus) {
          _otpFocusNode.requestFocus();
        }
      });
    }


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
                  /*theme.colorScheme.tertiary.withOpacity(0.9),*/
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
          // 🔹 Existing ones (keep as-is)

          // 🔹 Additional subtle circles
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
                        'Login via OTP',
                        style: theme.textTheme.headlineSmall?.copyWith(
                          fontWeight: FontWeight.bold,
                          color: theme.colorScheme.secondary,
                        ),
                      ),

                      const SizedBox(height: 6),

                      // 🔹 Subtitle
                      Text(
                        vm.showOtpField
                            ? 'Enter the OTP sent to your mobile'
                            : 'We will send an OTP to verify your number',
                        style: theme.textTheme.bodySmall,
                        textAlign: TextAlign.center,
                      ),

                      const SizedBox(height: 32),

                      // 🔹 Mobile Number
                      AppTextField(
                        label: 'Mobile Number',
                        keyboardType: TextInputType.number,
                        maxLength: 10,
                        textColor: vm.showOtpField? Colors.grey:Colors.black ,
                        onChanged: vm.setMobile,
                        readOnly: vm.showOtpField,   // 👈 use readOnly instead of enabled
                        suffix: vm.showOtpField
                            ? GestureDetector(
                          onTap: vm.changeMobile,
                          child: Container(
                            padding: const EdgeInsets.symmetric(horizontal: 8, vertical: 4),
                            child: Text(
                              "Change",
                              style: TextStyle(
                                color: AppColors.primary,
                                fontWeight: FontWeight.normal,
                                fontSize: 12.0,
                              ),
                            ),
                          )

                        )
                            : null,
                      ),




                      // 🔹 OTP FIELD (Animated)
                      AnimatedSize(
                        duration: const Duration(milliseconds: 300),
                        curve: Curves.easeOut,
                        child: vm.showOtpField
                            ? Padding(
                                padding: const EdgeInsets.only(top: 12),
                                child: AppTextField(
                                  focusNode: _otpFocusNode,
                                  label: 'OTP',
                                  keyboardType: TextInputType.number,
                                  maxLength: 6,
                                  onChanged: vm.setOtp,
                                ),
                              )
                            : const SizedBox.shrink(),
                      ),

                      const SizedBox(height: 24),

                      // 🔹 Action Button (Smooth UX)
                      SizedBox(
                        width: double.infinity,
                        height: 48,
                        child: ElevatedButton(
                          style: ElevatedButton.styleFrom(
                            backgroundColor: theme.colorScheme.secondary,
                            shape: RoundedRectangleBorder(
                              borderRadius: BorderRadius.circular(12),
                            ),
                          ),
                          onPressed: vm.isLoading
                              ? null
                              : vm.showOtpField
                              ? vm.login
                              : vm.sendOtp,
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
                                : Text(
                                    vm.showOtpField ? 'Login' : 'Send OTP',
                                    key: const ValueKey('text'),
                                    style: const TextStyle(
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
