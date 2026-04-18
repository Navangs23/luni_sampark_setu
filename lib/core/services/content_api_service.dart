import 'api_service.dart';

class ContentApiService {
  static Future<List<dynamic>> getContent({
    required String type,
    String apiCaller = "",
    String searchQuery = "",
  }) async {
    String endpoint = "admin/api/apiGetContent.php?type=$type";

    if (apiCaller.isNotEmpty) {
      endpoint += "&apiCaller=$apiCaller";
    }

    if (searchQuery.isNotEmpty) {
      endpoint += "&search=$searchQuery";
    }

    final response = await ApiService.get(endpoint: endpoint);

    if (response["success"] == true) {
      return response["data"];
    }

    return [];
  }
}
