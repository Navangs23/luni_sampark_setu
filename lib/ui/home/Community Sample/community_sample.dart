import 'package:flutter/material.dart';
import 'package:provider/provider.dart';

class CommunitySample extends StatelessWidget {
  final String pageTitle;
  const CommunitySample({super.key,required this.pageTitle});

  @override
  Widget build(BuildContext context) {
    return ChangeNotifierProvider(create: (_){},
    child: Scaffold(
      appBar: AppBar(
        title: Text(pageTitle),
      ),
      body: Center(
        child: Text.rich(
          TextSpan(
            children: [
              TextSpan(
                text: pageTitle,
                style: const TextStyle(
                  color: Colors.black,
                  fontWeight: FontWeight.bold,
                ),
              ),
              const TextSpan(
                text: " is Coming Soon...\nStay Tuned !!! 😀☺️",
              ),
            ],
          ),
          textAlign: TextAlign.center,
          style: TextStyle(fontSize: 16),
        ),

      ),
    ),);
  }
}
