import 'package:flutter/material.dart';
import 'package:luni_sampark_setu/core/services/session_service.dart';
import 'package:provider/provider.dart';
import '../../../../core/services/navigation_service.dart';
import '../../../common/widgets/AppGradientLoader.dart';
import 'add_member_viewmodel.dart';
import 'add_member_webview.dart';
import 'member_model.dart';

class AddMemberView extends StatelessWidget {
  String getUrl(String memberId, String operation) {
    String url =
        'https://panjoluni.com/mobile-app/appAddMember.php'
        '?op=$operation&id=$memberId';
    return url;
  }

  const AddMemberView({super.key});

  @override
  Widget build(BuildContext context) {
    return ChangeNotifierProvider(
      create: (_) =>
          AddMemberViewModel()..fetchMembers(SessionService.getFamilyId()),
      child: Scaffold(
        appBar: AppBar(
          title: const Text('View Family'),
          actions: [
            IconButton(
              onPressed: () {
                String addUrl = getUrl(SessionService.getUserId(), 'Add');
                NavigationService.push(
                  AddMemberWebView(url: addUrl, viewTitle: "Add Family Member"),
                );
              },
              icon: Icon(Icons.person_add_alt_rounded),
            ),
          ],
        ),
        body: Consumer<AddMemberViewModel>(
          builder: (context, vm, _) {
            if (vm.isLoading) {
              return const Center(child: AppColorCyclingLoader());
            }

            return RefreshIndicator(
              onRefresh: () async {
                await vm.fetchMembers(SessionService.getFamilyId());
              },
              child: ListView.builder(
                physics: const AlwaysScrollableScrollPhysics(),
                padding: const EdgeInsets.all(16),
                itemCount: vm.members.length,
                itemBuilder: (context, index) {
                  final Member m = vm.members[index];

                  return Card(
                    color: _hexToColor(m.backcolor),
                    shape: RoundedRectangleBorder(
                      borderRadius: BorderRadius.circular(14),
                    ),
                    child: PopupMenuButton<String>(
                      onSelected: (value) =>
                          _handleMenuAction(context, vm, m, value),
                      padding: EdgeInsets.zero,
                      itemBuilder: (context) => [
                        const PopupMenuItem(
                          value: 'view',
                          child: ListTile(
                            leading: Icon(Icons.visibility_outlined),
                            title: Text('View Profile'),
                            contentPadding: EdgeInsets.zero,
                            dense: true,
                          ),
                        ),
                        const PopupMenuItem(
                          value: 'edit',
                          child: ListTile(
                            leading: Icon(Icons.edit_outlined),
                            title: Text('Edit Profile'),
                            contentPadding: EdgeInsets.zero,
                            dense: true,
                          ),
                        ),
                        if (m.relation.toLowerCase() != 'self')
                          const PopupMenuItem(
                            value: 'delete',
                            child: ListTile(
                              leading: Icon(
                                Icons.delete_outline,
                                color: Colors.red,
                              ),
                              title: Text(
                                'Delete Profile',
                                style: TextStyle(color: Colors.red),
                              ),
                              contentPadding: EdgeInsets.zero,
                              dense: true,
                            ),
                          ),
                      ],
                      child: ListTile(
                        leading: CircleAvatar(
                          backgroundImage: NetworkImage(
                            m.image.replaceAll("https", "http"),
                          ),
                        ),
                        title: Text(
                          m.name,
                          style: const TextStyle(fontWeight: FontWeight.bold),
                        ),

                        subtitle: Text(m.relation),
                      ),
                    ),
                  );
                },
              ),
            );
          },
        ),
      ),
    );
  }

  void _handleMenuAction(
    BuildContext context,
    AddMemberViewModel vm,
    Member m,
    String action,
  ) {
    if (action == 'view') {
      NavigationService.push(
        AddMemberWebView(
          url: "https://panjoluni.com/mobile-app/appViewProfile.php?id=${m.id}",
          viewTitle: "View Profile",
        ),
      );
    } else if (action == 'edit') {
      String editUrl = getUrl(m.id, 'Edit');
      NavigationService.push(
        AddMemberWebView(url: editUrl, viewTitle: "Edit Family Member"),
      );
    } else if (action == 'delete') {
      _showDeleteConfirmation(context, vm, m);
    }
  }

  void _showDeleteConfirmation(
    BuildContext context,
    AddMemberViewModel vm,
    Member m,
  ) {
    showDialog(
      context: context,
      builder: (context) => AlertDialog(
        title: const Text("Delete Profile"),
        content: Text("Are you sure you want to delete ${m.name}'s profile?"),
        actions: [
          TextButton(
            onPressed: () => Navigator.pop(context),
            child: const Text("Cancel"),
          ),
          TextButton(
            onPressed: () async {
              Navigator.pop(context);
              final success = await vm.deleteMember(m.id);
              if (success && context.mounted) {
                ScaffoldMessenger.of(context).showSnackBar(
                  SnackBar(content: Text("${m.name} deleted successfully")),
                );
              }
            },
            style: TextButton.styleFrom(foregroundColor: Colors.red),
            child: const Text("Delete"),
          ),
        ],
      ),
    );
  }

  Color _hexToColor(String hex) {
    return Color(int.parse(hex.replaceFirst('#', 'FF'), radix: 16));
  }
}
