import 'package:flutter/material.dart';
import 'package:provider/provider.dart';

import '../../common/widgets/dashboard_card.dart';
import 'home_viewmodel.dart';

class HomeView extends StatelessWidget {
  const HomeView({super.key});

  @override
  Widget build(BuildContext context) {
    final vm = context.watch<HomeViewModel>();
    final theme = Theme.of(context);

    return Scaffold(
      backgroundColor: theme.scaffoldBackgroundColor,

      // 🔹 Dashboard Grid
      body: GridView.builder(
        padding: const EdgeInsets.all(8),
        itemCount: vm.items.length,
        gridDelegate: const SliverGridDelegateWithFixedCrossAxisCount(
          crossAxisCount: 2,
          mainAxisSpacing: 8,
          crossAxisSpacing: 8,
          childAspectRatio: 1.2,
        ),
        itemBuilder: (context, index) {
          final item = vm.items[index];
          return DashboardCard(
            title: item.title,
            icon: item.icon,
            onTap: item.onTap,
            index: index,
          );
        },
      ),
    );
  }
}
