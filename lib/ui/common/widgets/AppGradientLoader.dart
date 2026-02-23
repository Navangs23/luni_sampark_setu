import 'package:flutter/material.dart';
import 'package:luni_sampark_setu/core/theme/app_colors.dart';

class AppColorCyclingLoader extends StatefulWidget {
  const AppColorCyclingLoader({
    super.key,
    this.size = 36,
    this.strokeWidth = 4,
  });

  final double size;
  final double strokeWidth;

  @override
  State<AppColorCyclingLoader> createState() => _AppColorCyclingLoaderState();
}

class _AppColorCyclingLoaderState extends State<AppColorCyclingLoader>
    with SingleTickerProviderStateMixin {
  late final AnimationController _controller;

  final List<Color> _colors = AppColors.iconColors;

  @override
  void initState() {
    super.initState();
    _controller = AnimationController(
      vsync: this,
      duration: Duration(seconds: _colors.length),
    )..repeat();
  }

  @override
  void dispose() {
    _controller.dispose();
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    return AnimatedBuilder(
      animation: _controller,
      builder: (_, __) {
        final index =
            (_controller.value * _colors.length).floor() % _colors.length;
        debugPrint('index: $index');
        return SizedBox(
          width: widget.size,
          height: widget.size,
          child: CircularProgressIndicator(
            strokeWidth: widget.strokeWidth,
            valueColor: AlwaysStoppedAnimation(_colors[index]),
          ),
        );
      },
    );
  }
}
