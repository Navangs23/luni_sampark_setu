import 'dart:convert';
import 'package:http/http.dart' as http;

class ApiService {
  static const String baseUrl = "https://panjoluni.com/mobile-app/";
  static const String baseEndPointUrl = "https://panjoluni.com/";

  /// Generic POST request
  static Future<dynamic> post({
    required String endpoint,
    required Map<String, dynamic> body,
  }) async {
    final url = Uri.parse(baseUrl + endpoint);
    print("API Post: $url");

    try {
      final response = await http.post(url, body: body);

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
  static Future<dynamic> get({required String endpoint}) async {
    final url = Uri.parse(baseEndPointUrl + endpoint);
    print("API Get: $url");
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

  static Future<dynamic> getCelebration({required String endpoint}) async {
    final url = Uri.parse(baseUrl + endpoint);
    print("API GET Celebration: $url");
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
