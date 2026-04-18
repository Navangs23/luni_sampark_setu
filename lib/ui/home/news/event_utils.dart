import 'package:flutter/material.dart';

class EventUtils {
  static final Map<String, ({IconData icon, Color color, String category})>
  eventIcons = {
    // HAPPY
    "birthday": (icon: Icons.cake, color: Colors.pink, category: "Happy"),
    "celebration": (
      icon: Icons.celebration,
      color: Colors.orange,
      category: "Happy",
    ),
    "marriage": (
      icon: Icons.favorite,
      color: Colors.redAccent,
      category: "Happy",
    ),
    "festival": (icon: Icons.festival, color: Colors.purple, category: "Happy"),
    "music_event": (
      icon: Icons.music_note,
      color: Colors.blueAccent,
      category: "Happy",
    ),
    "sports_event": (
      icon: Icons.sports_soccer,
      color: Colors.green,
      category: "Happy",
    ),

    // SAD
    "death_news": (icon: Icons.spa, color: Colors.blueGrey, category: "Sad"),

    // ANNOUNCEMENTS
    "blood_donation": (
      icon: Icons.bloodtype,
      color: Colors.red,
      category: "Announcements",
    ),
    "get_together": (
      icon: Icons.groups,
      color: Colors.teal,
      category: "Announcements",
    ),
    "religious": (
      icon: Icons.temple_hindu,
      color: Colors.deepOrange,
      category: "Announcements",
    ),
    "meeting": (
      icon: Icons.meeting_room,
      color: Colors.brown,
      category: "Announcements",
    ),
    "education_event": (
      icon: Icons.school,
      color: Colors.indigo,
      category: "Announcements",
    ),
    "business_event": (
      icon: Icons.business,
      color: Colors.blueGrey.shade800,
      category: "Announcements",
    ),
    "community_event": (
      icon: Icons.people,
      color: Colors.cyan,
      category: "Announcements",
    ),
    "charity_event": (
      icon: Icons.volunteer_activism,
      color: Colors.pinkAccent,
      category: "Announcements",
    ),
    "announcement": (
      icon: Icons.campaign,
      color: Colors.amber.shade900,
      category: "Announcements",
    ),
  };

  static String formatDate(String? dateStr) {
    if (dateStr == null || dateStr.isEmpty) return "N/A";
    try {
      final date = DateTime.parse(dateStr);
      return "${date.day.toString().padLeft(2, '0')}-${date.month.toString().padLeft(2, '0')}-${date.year}";
    } catch (e) {
      return dateStr;
    }
  }

  static ({IconData icon, Color color}) getEventIconData(String? value) {
    if (value != null && value.isNotEmpty) {
      final parts = value.split("-");
      final name = parts[0];

      if (eventIcons.containsKey(name)) {
        final data = eventIcons[name]!;
        return (icon: data.icon, color: data.color);
      }
    }
    return (icon: Icons.event, color: Colors.blue);
  }
}
