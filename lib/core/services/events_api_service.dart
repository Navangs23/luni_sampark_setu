import 'dart:convert';
import 'package:http/http.dart' as http;

class EventsApiService {
  static const String baseUrl = "https://panjoluni.com/admin/api/";
  static const String eventsImageUrl = "${baseUrl}uploads/events/";

  static const String imageUrl = "${baseUrl}uploads/events/";

  static Future<List<dynamic>> getEvents() async {
    final uri = Uri.parse("${baseUrl}apiGetEvents.php?apiCaller=mobile");

    final response = await http.get(uri);

    if (response.statusCode == 200) {
      final data = jsonDecode(response.body);

      if (data["success"] == true) {
        return data["data"];
      }
    }

    return [];
  }
}
