import 'dart:convert';
import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'directory_member.dart';
import 'dart:async';

class DirectoryViewModel extends ChangeNotifier {
  bool isLoading = false;
  List<DirectoryMember> results = [];
  Timer? _debounce;

  void onSearchChanged(String query) {
    if (_debounce?.isActive ?? false) _debounce!.cancel();
    _debounce = Timer(const Duration(milliseconds: 500), () {
      if (query.length >= 2) {
        search(query);
      } else {
        results = [];
        notifyListeners();
      }
    });
  }

  Future<void> search(String query) async {
    isLoading = true;
    notifyListeners();

    try {
      final url = Uri.parse('https://panjoluni.com/mobile-app/getDirectorySearch.php?query=$query');
      final response = await http.get(url);

      if (response.statusCode == 200) {
        final data = json.decode(response.body);
        if (data['status'] == 'success') {
          results = (data['results'] as List)
              .map((e) => DirectoryMember.fromJson(e))
              .toList();
        }
      }
    } catch (e) {
      print("Error searching directory: $e");
    }

    isLoading = false;
    notifyListeners();
  }

  @override
  void dispose() {
    _debounce?.cancel();
    super.dispose();
  }
}
