import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import '../../../../core/services/navigation_service.dart';
import '../../../common/widgets/AppGradientLoader.dart';
import 'add_member_viewmodel.dart';
import 'add_member_webview.dart';
import 'member_model.dart';

class AddMemberView extends StatelessWidget {
  String getUrl(String memberId, String operation) {
    String url =
        'https://fairlorry.com/luni/appAddMember.php'
        '?op=$operation&id=$memberId';
    return url;
  }

  const AddMemberView({super.key});

  @override
  Widget build(BuildContext context) {
    return ChangeNotifierProvider(
      create: (_) => AddMemberViewModel()..fetchMembers(),
      child: Scaffold(
        appBar: AppBar(
          title: const Text('View Family'),
          actions: [
            IconButton(
              onPressed: () {
                String addUrl = getUrl('1', 'Add');
                NavigationService.push(AddMemberWebView(url: addUrl,viewTitle: "Add Family Member",));
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

            return ListView.builder(
              padding: const EdgeInsets.all(16),
              itemCount: vm.members.length,
              itemBuilder: (context, index) {
                final Member m = vm.members[index];

                return Card(
                  color: _hexToColor(m.backcolor),
                  shape: RoundedRectangleBorder(
                    borderRadius: BorderRadius.circular(14),
                  ),
                  child: InkWell(
                    onTap: () {
                      String editUrl = getUrl(m.id, 'Edit');
                      NavigationService.push(AddMemberWebView(url: editUrl,viewTitle: "Edit Family Member",));
                    },
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
                      trailing: const Icon(
                        Icons.chevron_right,
                        color: Colors.white,
                      ),
                      subtitle: Text(m.relation),
                    ),
                  ),
                );
              },
            );
          },
        ),
      ),
    );
  }

  Color _hexToColor(String hex) {
    return Color(int.parse(hex.replaceFirst('#', 'FF'), radix: 16));
  }
}
