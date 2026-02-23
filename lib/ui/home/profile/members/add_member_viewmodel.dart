import 'dart:convert';
import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'member_model.dart';

class AddMemberViewModel extends ChangeNotifier {
  bool isLoading = false;
  List<Member> members = [];

  Future<void> fetchMembers() async {
    isLoading = true;
    notifyListeners();

    final response = await http.get(
      Uri.parse('https://fairlorry.com/luni/raaApp/getProfileMembers.php?family_id=1'),
    );

    if (response.statusCode == 200) {
      final data = json.decode(response.body);
      members = (data['response'] as List)
          .map((e) => Member.fromJson(e))
          .toList();
    }

    isLoading = false;
    notifyListeners();
  }
}
