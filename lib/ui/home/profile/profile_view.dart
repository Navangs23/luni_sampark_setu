import 'package:flutter/material.dart';
import 'package:luni_sampark_setu/core/services/snackbar_service.dart';
import 'package:luni_sampark_setu/core/theme/app_colors.dart';
import 'package:luni_sampark_setu/ui/home/shell/home_shell_viewmodel.dart';
import 'package:luni_sampark_setu/ui/login/login_view.dart';
import 'package:provider/provider.dart';
import '../../../core/services/navigation_service.dart';
import '../../../core/services/session_service.dart';
import 'members/add_member_view.dart';
import 'members/add_member_webview.dart';

class ProfileView extends StatelessWidget {
  const ProfileView({super.key});

  @override
  Widget build(BuildContext context) {
    final theme = Theme.of(context);

    final items = const [
      _ProfileItem(Icons.family_restroom_rounded, "View Family"),
      _ProfileItem(Icons.search, 'Search'),
      _ProfileItem(Icons.business, 'Business Directory'),
      _ProfileItem(Icons.power_settings_new_rounded, 'Logout'),
    ];

    return SafeArea(
      child: ColoredBox(
        color: Colors.grey.shade50,
        child: Padding(
          padding: const EdgeInsets.all(16),
          child: Column(
            mainAxisSize: MainAxisSize.min,
            children: [
              // 🔹 Drag Handle
              Center(
                child: Container(
                  width: 40,
                  height: 4,
                  margin: const EdgeInsets.only(bottom: 20),
                  decoration: BoxDecoration(
                    color: Colors.grey.shade400,
                    borderRadius: BorderRadius.circular(2),
                  ),
                ),
              ),

              // 🔹 PROFILE CARD
              Card(
                elevation: 1.5,
                shape: RoundedRectangleBorder(
                  side: BorderSide(color: AppColors.primary, width: 1.0),
                  borderRadius: BorderRadius.circular(16),
                ),
                child: Padding(
                  padding: const EdgeInsets.all(16),
                  child: Row(
                    children: [
                      CircleAvatar(
                        radius: 32,
                        backgroundImage: const NetworkImage(
                          'https://picsum.photos/500/500',
                        ),
                      ),
                      const SizedBox(width: 16),
                      Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          Text(
                            SessionService.getName(),
                            style: theme.textTheme.titleMedium?.copyWith(
                              fontWeight: FontWeight.bold,
                              fontSize: 20,
                              color: theme.colorScheme.tertiary,
                            ),
                          ),
                          const SizedBox(height: 4),
                          Text(
                            SessionService.getMobileNumber(),
                            style: theme.textTheme.bodySmall?.copyWith(
                              color: AppColors.success,
                              fontWeight: FontWeight.w500,
                            ),
                          ),
                        ],
                      ),
                    ],
                  ),
                ),
              ),

              const SizedBox(height: 20),

              // 🔹 LIST CONTAINER (SINGLE CURVED SURFACE)
              Container(
                decoration: BoxDecoration(
                  color: theme.colorScheme.surface,
                  borderRadius: BorderRadius.circular(20),
                  boxShadow: [
                    BoxShadow(
                      color: Colors.black.withOpacity(0.05),
                      blurRadius: 8,
                      offset: const Offset(0, 4),
                    ),
                  ],
                ),
                child: ListView.separated(
                  shrinkWrap: true,
                  physics: const NeverScrollableScrollPhysics(),
                  itemCount: items.length,
                  separatorBuilder: (_, __) => Divider(
                    height: 1,
                    thickness: 0.5,
                    indent: 56,
                    endIndent: 16,
                    color: Colors.grey.shade300,
                  ),
                  itemBuilder: (context, index) {
                    final item = items[index];
                    return ListTile(
                      leading: Icon(
                        item.icon,
                        color: theme.colorScheme.primary,
                      ),
                      title: Text(
                        item.title,
                        style: theme.textTheme.bodyMedium?.copyWith(
                          fontWeight: FontWeight.w500,
                        ),
                      ),
                      trailing: const Icon(Icons.chevron_right),
                      onTap: () async {
                        if (item.title == 'Logout') {
                          Navigator.pop(context);
                          final rootContext =
                              NavigationService.navigatorKey.currentContext;
                          if (rootContext != null) {
                            rootContext.read<HomeShellViewModel>().reset();
                          }
                          SessionService.logout();
                          SessionService.init();
                          NavigationService.pushReplacement(LoginView());
                          SnackbarService.show(
                            "Logout Successful",
                            type: SnackbarType.success,
                          );
                        } else if (item.title == 'View Family') {
                          Navigator.pop(context);
                          NavigationService.push(const AddMemberView());
                        } else if (item.title == 'Search') {
                          NavigationService.pop();
                          NavigationService.push(
                            AddMemberWebView(
                              url:
                                  "https://fairlorry.com/luni/appProfileSearch.php?",
                              viewTitle: "Search Members",
                            ),
                          );
                        } else if (item.title == 'Business Directory') {
                          NavigationService.pop();
                          NavigationService.push(
                            AddMemberWebView(
                              url:
                                  "https://fairlorry.com/luni/appBusinessSearch.php?",
                              viewTitle: 'Business Directory',
                            ),
                          );
                        }
                      },
                    );
                  },
                ),
              ),

              const SizedBox(height: 20),

              // 🔹 AD SECTION
              ClipRRect(
                borderRadius: BorderRadius.circular(16),
                child: Image.asset(
                  'assets/banners/profile_banner.jpeg',
                  fit: BoxFit.cover,
                  width: 500,
                  height: 270,
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }
}

// 🔹 Data class
class _ProfileItem {
  final IconData icon;
  final String title;

  const _ProfileItem(this.icon, this.title);
}
