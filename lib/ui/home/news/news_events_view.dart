import 'package:flutter/material.dart';
import 'package:provider/provider.dart';

import '../../../core/theme/app_colors.dart';
import 'news_event_item.dart';
import 'news_events_viewmodel.dart';

class NewsEventsView extends StatelessWidget {
  const NewsEventsView({super.key});

  @override
  Widget build(BuildContext context) {
    final vm = context.watch<NewsEventsViewModel>();
    final theme = Theme.of(context);

    return Scaffold(
      body: ListView.separated(
        padding: const EdgeInsets.all(16),
        itemCount: vm.items.length,
        separatorBuilder: (_, __) => const SizedBox(height: 2),
        itemBuilder: (context, index) {
          final item = vm.items[index];
          return _NewsEventCard(
            item: item,
            theme: theme,
            context: context,
            index: index,
          );
        },
      ),
    );
  }
}

class _NewsEventCard extends StatelessWidget {
  final NewsEventItem item;
  final ThemeData theme;
  final BuildContext context;
  final int index;

  const _NewsEventCard({
    required this.item,
    required this.theme,
    required this.context,
    required this.index,
  });

  @override
  Widget build(BuildContext context) {
    return Card(
      shape: RoundedRectangleBorder(
        borderRadius: BorderRadius.circular(16),
        side: BorderSide(
          color: AppColors.iconColors[index % AppColors.iconColors.length],
        ),
      ),
      child: InkWell(
        borderRadius: BorderRadius.circular(16),
        onTap: () => _showDetails(context),
        child: Padding(
          padding: const EdgeInsets.all(12),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              // 🔹 Header Row
              Row(
                children: [
                  CircleAvatar(
                    radius: 18,
                    backgroundColor: AppColors
                        .iconColors[index % AppColors.iconColors.length]
                        .withOpacity(0.1),
                    child: Icon(
                      item.icon,
                      size: 18,
                      color: AppColors
                          .iconColors[index % AppColors.iconColors.length],
                    ),
                  ),
                  const SizedBox(width: 8),
                  Expanded(
                    child: Text(
                      _eventType(item.icon),
                      style: theme.textTheme.bodySmall?.copyWith(
                        fontWeight: FontWeight.w600,
                        color: AppColors
                            .iconColors[index % AppColors.iconColors.length],
                      ),
                    ),
                  ),
                  Text(
                    _formatDate(item.date),
                    style: theme.textTheme.bodySmall?.copyWith(
                      color: Colors.black,
                      fontWeight: FontWeight.bold,
                    ),
                  ),
                ],
              ),

              Divider(
                height: 20,
                color:
                    AppColors.iconColors[index % AppColors.iconColors.length],
              ),

              // 🔹 Title
              const SizedBox(height: 8),

              // 🔹 Content Row
              Row(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  ClipRRect(
                    borderRadius: BorderRadius.circular(12),
                    child: Image.network(
                      item.imageUrl,
                      width: 80,
                      height: 80,
                      fit: BoxFit.cover,
                    ),
                  ),
                  const SizedBox(width: 12),
                  Expanded(
                    child: Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: [
                        Text(
                          item.title,
                          style: theme.textTheme.titleMedium?.copyWith(
                            fontWeight: FontWeight.bold,
                          ),
                        ),
                        Text(
                          item.description,
                          maxLines: 2,
                          overflow: TextOverflow.ellipsis,
                        ),
                      ],
                    ),
                  ),
                ],
              ),
            ],
          ),
        ),
      ),
    );
  }

  void _showDetails(BuildContext context) {
    showModalBottomSheet(
      context: context,
      isScrollControlled: true,
      shape: const RoundedRectangleBorder(
        borderRadius: BorderRadius.vertical(top: Radius.circular(16)),
      ),
      builder: (_) => Padding(
        padding: const EdgeInsets.all(16),
        child: Column(
          mainAxisSize: MainAxisSize.min,
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Text(item.title, style: Theme.of(context).textTheme.titleLarge),
            const SizedBox(height: 8),
            Text(item.description),
            const SizedBox(height: 12),
            Text(
              'Date: ${_formatDate(item.date)}',
              style: Theme.of(context).textTheme.bodySmall,
            ),
          ],
        ),
      ),
    );
  }

  String _formatDate(DateTime date) => '${date.day}-${date.month}-${date.year}';

  String _eventType(IconData icon) {
    if (icon == Icons.groups) return 'Community Event';
    if (icon == Icons.bloodtype) return 'Health Camp';
    if (icon == Icons.celebration) return 'Festival';
    return 'Event';
  }
}
