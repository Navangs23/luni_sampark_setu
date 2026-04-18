import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:url_launcher/url_launcher.dart';
import '../profile/members/add_member_webview.dart';
import 'directory_viewmodel.dart';
import 'directory_member.dart';

class DirectoryView extends StatelessWidget {
  const DirectoryView({super.key});

  @override
  Widget build(BuildContext context) {
    return ChangeNotifierProvider(
      create: (_) => DirectoryViewModel(),
      child: Scaffold(
        appBar: AppBar(
          title: const Text("Directory"),
          backgroundColor: Colors.white,
          foregroundColor: Colors.black,
          elevation: 0,
        ),
        body: Column(
          children: [
            Padding(
              padding: const EdgeInsets.all(16.0),
              child: Consumer<DirectoryViewModel>(
                builder: (context, vm, child) => TextField(
                  onChanged: vm.onSearchChanged,
                  decoration: InputDecoration(
                    hintText: "Search by name or phone number...",
                    prefixIcon: const Icon(Icons.search),
                    border: OutlineInputBorder(
                      borderRadius: BorderRadius.circular(12),
                    ),
                    filled: true,
                    fillColor: Colors.grey[100],
                  ),
                ),
              ),
            ),
            Expanded(
              child: Consumer<DirectoryViewModel>(
                builder: (context, vm, child) {
                  if (vm.isLoading) {
                    return const Center(child: CircularProgressIndicator());
                  }

                  if (vm.results.isEmpty) {
                    return const Center(
                      child: Text("Search for community members"),
                    );
                  }

                  return ListView.builder(
                    padding: const EdgeInsets.symmetric(horizontal: 16),
                    itemCount: vm.results.length,
                    itemBuilder: (context, index) {
                      final member = vm.results[index];
                      return _DirectoryMemberCard(member: member);
                    },
                  );
                },
              ),
            ),
          ],
        ),
      ),
    );
  }
}

class _DirectoryMemberCard extends StatelessWidget {
  final DirectoryMember member;

  const _DirectoryMemberCard({required this.member});

  @override
  Widget build(BuildContext context) {
    final bool isMale = member.gender.toLowerCase() == 'male';
    final Color accentColor = isMale ? const Color(0xFF90CAF9) : const Color(0xFFF48FB1);
    final Gradient bgGradient = isMale
        ? const LinearGradient(
            begin: Alignment.topCenter,
            end: Alignment.bottomCenter,
            colors: [Color(0xFFF4F9FF), Color(0xFFE8F2FB)],
          )
        : const LinearGradient(
            begin: Alignment.topCenter,
            end: Alignment.bottomCenter,
            colors: [Color(0xFFFFF7FA), Color(0xFFFDECEF)],
          );

    return Container(
      margin: const EdgeInsets.only(bottom: 16),
      decoration: BoxDecoration(
        gradient: bgGradient,
        borderRadius: BorderRadius.circular(18),
        boxShadow: [
          BoxShadow(
            color: Colors.black.withOpacity(0.04),
            blurRadius: 10,
            offset: const Offset(0, 3),
          ),
        ],
      ),
      clipBehavior: Clip.antiAlias,
      child: Stack(
        children: [
          // Left Accent Bar
          Positioned(
            left: 0,
            top: 0,
            bottom: 0,
            width: 4,
            child: Container(color: accentColor),
          ),
          Padding(
            padding: const EdgeInsets.all(14),
            child: Row(
              crossAxisAlignment: CrossAxisAlignment.center,
              children: [
                // Avatar with Border
                Container(
                  padding: const EdgeInsets.all(2),
                  decoration: BoxDecoration(
                    shape: BoxShape.circle,
                    border: Border.all(color: accentColor.withOpacity(0.5), width: 2),
                  ),
                  child: CircleAvatar(
                    radius: 30,
                    backgroundColor: Colors.grey[200],
                    backgroundImage: NetworkImage(member.photo),
                  ),
                ),
                const SizedBox(width: 14),
                // Details
                Expanded(
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    mainAxisSize: MainAxisSize.min,
                    children: [
                      Row(
                        children: [
                          Icon(
                            isMale ? Icons.face_rounded : Icons.face_3_rounded,
                            size: 18,
                            color: accentColor.darken(0.3),
                          ),
                          const SizedBox(width: 6),
                          Expanded(
                            child: Text(
                              member.fullName,
                              maxLines: 1,
                              overflow: TextOverflow.ellipsis,
                              style: const TextStyle(
                                fontSize: 16,
                                fontWeight: FontWeight.bold,
                                color: Color(0xFF263238),
                              ),
                            ),
                          ),
                        ],
                      ),
                      const SizedBox(height: 4),
                      Text(
                        member.mobileNo,
                        style: const TextStyle(
                          fontSize: 14,
                          color: Color(0xFF455A64),
                          fontWeight: FontWeight.w500,
                        ),
                      ),
                      const SizedBox(height: 4),
                      InkWell(
                        onTap: () => _viewProfile(context, member),
                        child: Text(
                          "View Profile",
                          style: TextStyle(
                            fontSize: 12,
                            color: const Color(0xFFD81C5B),
                            fontWeight: FontWeight.bold,
                            decoration: TextDecoration.underline,
                            decorationColor: const Color(0xFFD81C5B).withOpacity(0.4),
                          ),
                        ),
                      ),
                    ],
                  ),
                ),
                const SizedBox(width: 12),
                // BIG CALL BUTTON ON RIGHT
                Material(
                  color: Colors.transparent,
                  child: InkWell(
                    onTap: () => _makeCall(member.mobileNo),
                    borderRadius: BorderRadius.circular(30),
                    child: Container(
                      padding: const EdgeInsets.all(12),
                      decoration: BoxDecoration(
                        color: Colors.green[600],
                        shape: BoxShape.circle,
                        boxShadow: [
                          BoxShadow(
                            color: Colors.green.withOpacity(0.3),
                            blurRadius: 8,
                            offset: const Offset(0, 4),
                          ),
                        ],
                      ),
                      child: const Icon(
                        Icons.call,
                        color: Colors.white,
                        size: 26,
                      ),
                    ),
                  ),
                ),
              ],
            ),
          ),
        ],
      ),
    );
  }

  void _makeCall(String number) async {
    final Uri url = Uri.parse("tel:$number");
    if (await canLaunchUrl(url)) {
      await launchUrl(url);
    }
  }

  void _viewProfile(BuildContext context, DirectoryMember member) {
    Navigator.push(
      context,
      MaterialPageRoute(
        builder: (context) => AddMemberWebView(
          url: "https://panjoluni.com/mobile-app/appViewProfile.php?id=${member.id}",
          viewTitle: "Profile Details",
        ),
      ),
    );
  }
}

extension ColorExtension on Color {
  Color darken([double amount = .1]) {
    assert(amount >= 0 && amount <= 1);
    final hsl = HSLColor.fromColor(this);
    final hslDark = hsl.withLightness((hsl.lightness - amount).clamp(0.0, 1.0));
    return hslDark.toColor();
  }
}
