import 'package:flutter/material.dart';
import 'package:flutter/foundation.dart'; // for debugPrint (safe import)

import '../../../core/services/api_service.dart';
import '../../../core/services/events_api_service.dart';
import '../../../core/services/session_service.dart';
import 'celebration_model.dart';
import 'news_event_item.dart';

class NewsEventsViewModel extends ChangeNotifier {
  List<NewsEventItem> _events = [];
  List<CelebrationModel> _celebrations = [];
  bool _loading = false;

  List<NewsEventItem> get items => _events;
  List<CelebrationModel> get celebrations => _celebrations;
  bool get loading => _loading;

  Future<void> fetchEvents() async {
    _loading = true;
    notifyListeners();

    try {
      await fetchCelebrations();
      final data = await EventsApiService.getEvents();

      _events = data.map<NewsEventItem>((e) {
        // Icon parsing (unchanged - works perfectly)
        final iconRaw = e["icon"] ?? "";
        String iconName = "event";
        String category = "Announcements";

        if (iconRaw.contains("-")) {
          final parts = iconRaw.split("-");
          iconName = parts[0];
          category = parts[1];
        }

        // NEW: Full mapping to match admin panel + updated model
        return NewsEventItem(
          title: e["title"] ?? "",
          date: DateTime.tryParse(e["date"] ?? "") ?? DateTime.now(),

          // New fields from admin panel
          status: e["status"],
          shortDescription: e["short_description"] ?? "",
          longDescription: e["long_description"],

          // Cover image (full URL - same as before)
          imageUrl:
              "${EventsApiService.eventsImageUrl}${e["cover_imageUrl"] ?? ""}",

          // Multiple event images (JSON string - used in carousel)
          eventImages: e["event_imageUrl"] ?? e["eventImages"],

          // Google Photos link
          googlePhotosLink: e["google_photos_link"],

          // Icon logic (unchanged)
          iconName: iconName,
          category: category,
        );
      }).toList();
    } catch (e) {
      debugPrint("Events fetch error: $e");
    }

    _loading = false;
    notifyListeners();
  }

  Future<void> fetchCelebrations() async {
    final familyId = SessionService.getFamilyId();
    if (familyId.isEmpty) return;

    try {
      final response = await ApiService.getCelebration(
        endpoint: "getFamilyCelebrations.php?family_id=$familyId",
      );

      if (response["success"] == true) {
        final List data = response["data"] ?? [];
        _celebrations = data.map((e) => CelebrationModel.fromJson(e)).toList();
      }
    } catch (e) {
      debugPrint("Celebrations fetch error: $e");
    }
  }
}
