import 'package:intl/intl.dart';

class CalendarUtils {
  /// Generates a Google Calendar URL for a given event or live stream.
  static String generateGoogleCalendarUrl({
    required String title,
    required String description,
    required DateTime date,
    String? location,
    bool isAllDay = true,
  }) {
    final DateFormat formatter = DateFormat("yyyyMMdd'T'HHmmss'Z'");
    
    // For all day events, Google Calendar expects dates in YYYYMMDD format
    // or YYYYMMDD/YYYYMMDD+1. 
    // For simplicity, we'll use a 1-hour window if not all day.
    final String start = formatter.format(date.toUtc());
    final String end = formatter.format(date.add(const Duration(hours: 1)).toUtc());

    final String encodedTitle = Uri.encodeComponent(title);
    final String encodedDesc = Uri.encodeComponent(description);
    final String encodedLoc = location != null ? Uri.encodeComponent(location) : '';

    return 'https://www.google.com/calendar/render?action=TEMPLATE'
        '&text=$encodedTitle'
        '&details=$encodedDesc'
        '&location=$encodedLoc'
        '&dates=$start/$end';
  }
}
