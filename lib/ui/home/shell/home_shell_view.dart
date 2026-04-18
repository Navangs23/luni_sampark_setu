import 'package:flutter/material.dart';
import 'package:luni_sampark_setu/core/services/notification_service.dart';
import 'package:luni_sampark_setu/core/services/navigation_service.dart';
import 'package:luni_sampark_setu/core/theme/app_colors.dart';
import 'package:provider/provider.dart';

import '../dashboard/home_view.dart';
import '../dashboard/home_viewmodel.dart';
import '../news/news_events_view.dart';
import '../notifications/notifications_view.dart';
import '../profile/profile_view.dart';
import 'home_shell_viewmodel.dart';

class HomeShellView extends StatefulWidget {
  const HomeShellView({super.key});

  @override
  State<HomeShellView> createState() => _HomeShellViewState();
}

class _HomeShellViewState extends State<HomeShellView> {
  @override
  void initState() {
    super.initState();
    WidgetsBinding.instance.addPostFrameCallback((_) {
      context.read<HomeShellViewModel>().loadUser();
      NotificationService.setAppReady();
    });
  }

  @override
  Widget build(BuildContext context) {
    final vms = context.watch<HomeViewModel>();
    final theme = Theme.of(context);
    final vm = context.watch<HomeShellViewModel>();

    final pages = const [
      NewsEventsView(), // 0
      HomeView(), // 1
    ];

    return Scaffold(
      appBar: AppBar(
        centerTitle: false,
        backgroundColor: theme.colorScheme.primary,
        actions: [
          Padding(
            padding: const EdgeInsets.only(right: 8.0),
            child: Badge(
              label: Text(
                vm.unreadCount > 99 ? '99+' : vm.unreadCount.toString(),
                style: const TextStyle(
                  color: Colors.white,
                  fontSize: 10,
                  fontWeight: FontWeight.bold,
                ),
              ),
              alignment: Alignment.topRight,
              isLabelVisible: vm.unreadCount > 0,
              backgroundColor: AppColors.secondary,
              padding: const EdgeInsets.symmetric(horizontal: 6, vertical: 2),
              largeSize: 20,
              offset: const Offset(6, -2),
              child: IconButton(
                style: IconButton.styleFrom(
                  backgroundColor: Colors.white.withOpacity(0.35),
                  shape: RoundedRectangleBorder(
                    borderRadius: BorderRadius.circular(12),
                  ),
                ),
                onPressed: () {
                  NavigationService.push(const NotificationsView()).then((_) {
                    vm.fetchUnreadCount();
                  });
                },
                icon: const Icon(
                  Icons.notifications_outlined,
                  size: 26,
                  color: Colors.white,
                ),
              ),
            ),
          ),
        ],
        title: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Text(
              'WELCOME',
              style: theme.textTheme.labelLarge?.copyWith(
                fontWeight: FontWeight.bold,
                fontSize: 18,
                letterSpacing: 1,
                color: Colors.white,
              ),
            ),
            const SizedBox(height: 2),
            Text(
              vm.userName, // from ViewModel
              style: theme.textTheme.bodySmall?.copyWith(
                fontSize: 12,
                color: Colors.white,
              ),
            ),
          ],
        ),
      ),
      body: IndexedStack(index: vm.currentIndex, children: pages),

      bottomNavigationBar: NavigationBar(
        selectedIndex: vm.currentIndex,
        indicatorColor: AppColors.primary,
        labelBehavior: NavigationDestinationLabelBehavior.alwaysShow,
        onDestinationSelected: (index) {
          if (index == 2) {
            _openProfileSheet(context);
          } else {
            vm.setIndex(index);
          }
        },
        destinations: [
          const NavigationDestination(icon: Icon(Icons.event), label: 'News'),
          const NavigationDestination(
            icon: Icon(Icons.groups),
            label: 'Community',
          ),
          NavigationDestination(
            icon: vm.profilePicUrl.isNotEmpty
                ? CircleAvatar(
                    radius: 14,
                    backgroundImage: NetworkImage(vm.profilePicUrl),
                  )
                : const Icon(Icons.person, size: 28),
            label: 'Profile',
          ),
        ],
      ),
    );
  }

  void _openProfileSheet(BuildContext context) {
    showModalBottomSheet(
      context: context,
      isScrollControlled: true,
      shape: const RoundedRectangleBorder(
        borderRadius: BorderRadius.vertical(top: Radius.circular(16)),
      ),
      builder: (_) => const ProfileView(),
    );
  }
}
