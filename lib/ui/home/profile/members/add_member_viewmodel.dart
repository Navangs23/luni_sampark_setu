import 'dart:convert';
import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'member_model.dart';

class AddMemberViewModel extends ChangeNotifier {
  bool isLoading = false;
  List<Member> members = [];

  Future<void> fetchMembers(String familyId) async {
    isLoading = true;
    notifyListeners();
    String fetchMembersUrl =
        'https://panjoluni.com/mobile-app/getProfileMembers.php?family_id=$familyId';
    print(fetchMembersUrl);
    final response = await http.get(Uri.parse(fetchMembersUrl));
    print("Response: ${response.body}");

    if (response.statusCode == 200) {
      final data = json.decode(response.body);
      members = (data['response'] as List)
          .map((e) => Member.fromJson(e))
          .toList();
    }

    isLoading = false;
    notifyListeners();
  }

  Future<bool> deleteMember(String memberId) async {
    isLoading = true;
    notifyListeners();

    try {
      final url = Uri.parse('https://panjoluni.com/mobile-app/appDeleteMember.php');
      final response = await http.post(url, body: {'id': memberId});

      if (response.statusCode == 200) {
        final data = json.decode(response.body);
        if (data['status'] == 'success') {
          members.removeWhere((m) => m.id == memberId);
          isLoading = false;
          notifyListeners();
          return true;
        }
      }
    } catch (e) {
      print("Error deleting member: $e");
    }

    isLoading = false;
    notifyListeners();
    return false;
  }
}
