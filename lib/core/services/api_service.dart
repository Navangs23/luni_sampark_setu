import 'dart:convert';
import 'package:http/http.dart' as http;

class ApiService {
  static const String baseUrl = "https://fairlorry.com/luni/";

  /// Generic POST request
  static Future<dynamic> post({
    required String endpoint,
    required Map<String, dynamic> body,
  }) async {
    final url = Uri.parse(baseUrl + endpoint);

    try {
      final response = await http.post(
        url,
        body: body,
      );

      if (response.statusCode == 200) {
        return json.decode(response.body);
      } else {
        throw Exception("Server error: ${response.statusCode}");
      }
    } catch (e) {
      throw Exception("Network error: $e");
    }
  }

  /// Generic GET request (for future use)
  static Future<dynamic> get({
    required String endpoint,
  }) async {
    final url = Uri.parse(baseUrl + endpoint);

    try {
      final response = await http.get(url);

      if (response.statusCode == 200) {
        return json.decode(response.body);
      } else {
        throw Exception("Server error: ${response.statusCode}");
      }
    } catch (e) {
      throw Exception("Network error: $e");
    }
  }
}
