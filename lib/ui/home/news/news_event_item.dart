import 'package:flutter/material.dart';

class NewsEventItem {
  final String title;
  final String description;
  final DateTime date;
  final IconData icon;
  final String imageUrl;

  const NewsEventItem({
    required this.title,
    required this.description,
    required this.date,
    required this.icon,
    required this.imageUrl,
  });
}
