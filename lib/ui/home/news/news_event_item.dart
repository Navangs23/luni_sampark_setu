import 'package:flutter/material.dart';

class NewsEventItem {
  final String title;
  final DateTime date;
  final String? status; // ← NEW: active / inactive badge
  final String? shortDescription; // ← NEW: short description
  final String? longDescription; // ← NEW: HTML long description
  final String imageUrl; // cover image (full URL or path as per your API)
  final String?
  eventImages; // JSON string of multiple images (same as web event_imageUrl)
  final String? googlePhotosLink; // ← already had
  final String iconName;
  final String category;

  NewsEventItem({
    required this.title,
    required this.date,
    this.status,
    this.shortDescription,
    this.longDescription,
    required this.imageUrl,
    this.eventImages,
    this.googlePhotosLink,
    required this.iconName,
    required this.category,
  });

  // Optional: Add fromJson if you parse from API
  factory NewsEventItem.fromJson(Map<String, dynamic> json) {
    return NewsEventItem(
      title: json['title'] ?? '',
      date: DateTime.parse(json['date'] ?? DateTime.now().toIso8601String()),
      status: json['status'],
      shortDescription: json['short_description'],
      longDescription: json['long_description'],
      imageUrl: json['cover_imageUrl'] ?? json['imageUrl'] ?? '',
      eventImages: json['event_imageUrl'] ?? json['eventImages'],
      googlePhotosLink: json['google_photos_link'],
      iconName: json['iconName'] ?? '',
      category: json['category'] ?? '',
    );
  }
}
