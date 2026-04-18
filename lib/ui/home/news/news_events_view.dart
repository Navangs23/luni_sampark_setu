import 'dart:math' as Math;
import 'package:confetti/confetti.dart';
import 'package:flutter/material.dart';
import 'package:luni_sampark_setu/core/services/notification_service.dart';
import 'package:provider/provider.dart';

import '../../../core/theme/app_colors.dart';
import 'celebration_model.dart';
import 'event_utils.dart';
import 'news_event_details_view.dart';
import 'news_event_item.dart';
import 'news_events_viewmodel.dart';

class NewsEventsView extends StatefulWidget {
  const NewsEventsView({super.key});

  @override
  State<NewsEventsView> createState() => _NewsEventsViewState();
}

class _NewsEventsViewState extends State<NewsEventsView> {
  late ConfettiController _leftConfettiController;
  late ConfettiController _rightConfettiController;
  late ConfettiController _centerConfettiController;

  @override
  void initState() {
    super.initState();
    _leftConfettiController = ConfettiController(
      duration: const Duration(seconds: 3),
    );
    _rightConfettiController = ConfettiController(
      duration: const Duration(seconds: 3),
    );
    _centerConfettiController = ConfettiController(
      duration: const Duration(seconds: 3),
    );

    Future.microtask(() {
      context.read<NewsEventsViewModel>().fetchEvents();
      NotificationService.markNotificationsByTypeAsRead(['news', 'event']);
    });
  }

  @override
  void dispose() {
    _leftConfettiController.dispose();
    _rightConfettiController.dispose();
    _centerConfettiController.dispose();
    super.dispose();
  }

  void _playCelebration() {
    _leftConfettiController.play();
    _rightConfettiController.play();
    _centerConfettiController.play();
  }

  /// Path for star-shaped confetti
  Path drawStar(Size size) {
    double degToRad(double deg) => deg * (3.1415926535897932 / 180.0);
    const numberOfPoints = 5;
    final halfWidth = size.width / 2;
    final externalRadius = halfWidth;
    final internalRadius = halfWidth / 2.5;
    final degreesPerStep = degToRad(360 / numberOfPoints);
    final halfDegreesPerStep = degreesPerStep / 2;
    final path = Path();
    final fullAngle = degToRad(360);
    path.moveTo(size.width, halfWidth);
    for (double step = 0; step < fullAngle; step += degreesPerStep) {
      path.lineTo(
        halfWidth + externalRadius * Math.cos(step),
        halfWidth + externalRadius * Math.sin(step),
      );
      path.lineTo(
        halfWidth + internalRadius * Math.cos(step + halfDegreesPerStep),
        halfWidth + internalRadius * Math.sin(step + halfDegreesPerStep),
      );
    }
    path.close();
    return path;
  }

  @override
  Widget build(BuildContext context) {
    final vm = context.watch<NewsEventsViewModel>();
    final theme = Theme.of(context);

    if (vm.loading) {
      return const Scaffold(body: Center(child: CircularProgressIndicator()));
    }

    return Scaffold(
      body: Stack(
        children: [
          RefreshIndicator(
            onRefresh: () => vm.fetchEvents(),
            child: vm.items.isEmpty && vm.celebrations.isEmpty
                ? const Center(child: Text("No Events Available"))
                : ListView(
                    padding: const EdgeInsets.all(16),
                    children: [
                      if (vm.celebrations.isNotEmpty) ...[
                        _CelebrationCard(
                          celebrations: vm.celebrations,
                          theme: theme,
                          onTap: _playCelebration,
                        ),
                        const SizedBox(height: 16),
                      ],
                      ...vm.items.asMap().entries.map((entry) {
                        final index = entry.key;
                        final item = entry.value;
                        return Column(
                          children: [
                            _NewsEventCard(item: item, theme: theme),
                            if (index < vm.items.length - 1)
                              const SizedBox(height: 8),
                          ],
                        );
                      }),
                    ],
                  ),
          ),

          // 🎈 POPPER ICONS & RAIN
          if (vm.celebrations.isNotEmpty) ...[
            // 1. Left Popper
            Align(
              alignment: Alignment.topLeft,
              child: Padding(
                padding: const EdgeInsets.only(top: 10, left: 10),
                child: Stack(
                  alignment: Alignment.topCenter,
                  children: [
                    /*Transform.rotate(
                      angle: Math.pi / 4,
                      child: const Icon(
                        Icons.celebration,
                        size: 40,
                        color: Colors.amber,
                      ),
                    ),*/
                    ConfettiWidget(
                      confettiController: _leftConfettiController,
                      blastDirection: Math.pi / 2,
                      blastDirectionality:
                          BlastDirectionality.explosive, // 👈 IMPORTANT
                      emissionFrequency: 0.2,
                      numberOfParticles: 20,
                      maxBlastForce: 25,
                      minBlastForce: 10,
                      gravity: 0.2,
                      shouldLoop: false,
                      colors: const [
                        AppColors.secondary,
                        Colors.amber,
                        Colors.white,
                      ],
                      createParticlePath: drawStar,
                    ),
                  ],
                ),
              ),
            ),

            // 2. Right Popper
            Align(
              alignment: Alignment.topRight,
              child: Padding(
                padding: const EdgeInsets.only(top: 10, right: 10),
                child: Stack(
                  alignment: Alignment.topCenter,
                  children: [
                    /* Transform.rotate(
                      angle: -Math.pi / 4,
                      child: const Icon(
                        Icons.celebration,
                        size: 40,
                        color: Colors.amber,
                      ),
                    ),*/
                    ConfettiWidget(
                      confettiController: _rightConfettiController,
                      blastDirection: Math.pi / 2,
                      blastDirectionality: BlastDirectionality.explosive,
                      emissionFrequency: 0.2,
                      numberOfParticles: 20,
                      maxBlastForce: 25,
                      minBlastForce: 10,
                      gravity: 0.2,
                      shouldLoop: false,
                      colors: const [
                        AppColors.primary,
                        Colors.amber,
                        Colors.white,
                      ],
                      createParticlePath: drawStar,
                    ),
                  ],
                ),
              ),
            ),

            // 3. Center Popper
            Align(
              alignment: Alignment.topCenter,
              child: Padding(
                padding: const EdgeInsets.only(top: 5),
                child: Stack(
                  alignment: Alignment.topCenter,
                  children: [
                    /*const Icon(
                      Icons.celebration,
                      size: 45,
                      color: Colors.white,
                    ),*/
                    ConfettiWidget(
                      confettiController: _centerConfettiController,
                      blastDirectionality: BlastDirectionality.explosive,
                      emissionFrequency: 0.3,
                      numberOfParticles: 20,
                      maxBlastForce: 15,
                      minBlastForce: 5,
                      gravity: 0.3,
                      shouldLoop: false,
                      colors: const [
                        Colors.amber,
                        Colors.orange,
                        Colors.pinkAccent,
                        Colors.lightBlueAccent,
                      ],
                    ),
                  ],
                ),
              ),
            ),
          ],
        ],
      ),
    );
  }
}

class _NewsEventCard extends StatelessWidget {
  final NewsEventItem item;
  final ThemeData theme;

  const _NewsEventCard({required this.item, required this.theme});

  @override
  Widget build(BuildContext context) {
    final iconData = EventUtils.getEventIconData(
      "${item.iconName}-${item.category}",
    );
    final icon = iconData.icon;
    final color = iconData.color;

    return Card(
      shape: RoundedRectangleBorder(
        borderRadius: BorderRadius.circular(16),
        side: BorderSide(color: color),
      ),
      child: InkWell(
        borderRadius: BorderRadius.circular(16),
        onTap: () {
          Navigator.push(
            context,
            MaterialPageRoute(builder: (_) => EventDetailsPage(item: item)),
          );
        },
        child: Padding(
          padding: const EdgeInsets.all(12),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              Row(
                children: [
                  CircleAvatar(
                    radius: 18,
                    backgroundColor: color.withOpacity(0.15),
                    child: Icon(icon, size: 18, color: color),
                  ),
                  const SizedBox(width: 8),
                  Expanded(
                    child: Text(
                      item.iconName.replaceAll("_", " ").toUpperCase(),
                      style: theme.textTheme.bodySmall?.copyWith(
                        fontWeight: FontWeight.w600,
                        color: color,
                      ),
                    ),
                  ),
                  Text(
                    EventUtils.formatDate(item.date.toString()),
                    style: theme.textTheme.bodySmall?.copyWith(
                      color: Colors.black,
                      fontWeight: FontWeight.bold,
                    ),
                  ),
                ],
              ),
              Divider(height: 20, color: color),
              Row(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Container(
                    width: 80,
                    height: 80,
                    decoration: BoxDecoration(
                      border: Border.all(color: color, width: 1),
                      borderRadius: BorderRadius.circular(12),
                    ),
                    padding: const EdgeInsets.all(2),
                    child: ClipRRect(
                      borderRadius: BorderRadius.circular(10),
                      child: FadeInImage.assetNetwork(
                        placeholder: 'assets/icons/app_logo.png',
                        image: item.imageUrl,
                        width: 80,
                        height: 80,
                        fit: BoxFit.contain,
                        fadeInDuration: const Duration(milliseconds: 200),
                        imageErrorBuilder: (context, error, stackTrace) {
                          return Container(
                            color: Colors.grey.shade200,
                            child: const Icon(
                              Icons.image_not_supported,
                              size: 30,
                              color: Colors.grey,
                            ),
                          );
                        },
                      ),
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
                        const SizedBox(height: 4),
                        Text(
                          item.shortDescription ??
                              item.longDescription ??
                              'No description available.',
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
}

class _CelebrationCard extends StatelessWidget {
  final List<CelebrationModel> celebrations;
  final ThemeData theme;
  final VoidCallback onTap;

  const _CelebrationCard({
    required this.celebrations,
    required this.theme,
    required this.onTap,
  });

  @override
  Widget build(BuildContext context) {
    WidgetsBinding.instance.addPostFrameCallback((_) {
      onTap();
    });

    return GestureDetector(
      onTap: onTap,
      child: Container(
        width: double.infinity,
        decoration: BoxDecoration(
          gradient: LinearGradient(
            colors: [
              AppColors.primary,
              AppColors.primary.withOpacity(0.8),
              AppColors.secondary.withOpacity(0.9),
            ],
            begin: Alignment.topLeft,
            end: Alignment.bottomRight,
          ),
          borderRadius: BorderRadius.circular(20),
          boxShadow: [
            BoxShadow(
              color: AppColors.primary.withOpacity(0.3),
              blurRadius: 12,
              offset: const Offset(0, 6),
            ),
          ],
        ),
        child: Stack(
          children: [
            Positioned(
              right: -20,
              top: -20,
              child: Icon(
                Icons.celebration,
                size: 100,
                color: Colors.white.withOpacity(0.1),
              ),
            ),
            Padding(
              padding: const EdgeInsets.all(20),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Row(
                    children: [
                      const Icon(Icons.star, color: Colors.amber, size: 28),
                      const SizedBox(width: 8),
                      Text(
                        "SPECIAL CELEBRATION!",
                        style: theme.textTheme.titleSmall?.copyWith(
                          color: Colors.white,
                          fontWeight: FontWeight.bold,
                          letterSpacing: 1.2,
                        ),
                      ),
                    ],
                  ),
                  const SizedBox(height: 16),
                  ...celebrations.map(
                    (member) => _buildCelebrantRow(theme, member),
                  ),
                ],
              ),
            ),
          ],
        ),
      ),
    );
  }

  Widget _buildCelebrantRow(ThemeData theme, CelebrationModel member) {
    final isBirthday = member.type == 'Birthday';
    final message = isBirthday ? "Happy Birthday!" : "Happy Anniversary!";
    final icon = isBirthday ? Icons.cake_rounded : Icons.favorite_rounded;

    return Padding(
      padding: const EdgeInsets.only(bottom: 12),
      child: Row(
        children: [
          Container(
            padding: const EdgeInsets.all(2),
            decoration: BoxDecoration(
              shape: BoxShape.circle,
              border: Border.all(color: Colors.white, width: 2),
            ),
            child: CircleAvatar(
              radius: 24,
              backgroundImage: NetworkImage(member.image),
              backgroundColor: Colors.white.withOpacity(0.2),
              child: member.image.isEmpty
                  ? const Icon(Icons.person, color: Colors.white)
                  : null,
            ),
          ),
          const SizedBox(width: 12),
          Expanded(
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Text(
                  member.name,
                  style: theme.textTheme.titleMedium?.copyWith(
                    color: Colors.white,
                    fontWeight: FontWeight.bold,
                  ),
                ),
                Row(
                  children: [
                    Icon(icon, size: 16, color: Colors.white70),
                    const SizedBox(width: 4),
                    Text(
                      "$message (${member.relation})",
                      style: theme.textTheme.bodySmall?.copyWith(
                        color: Colors.white.withOpacity(0.9),
                        fontWeight: FontWeight.w500,
                      ),
                    ),
                  ],
                ),
              ],
            ),
          ),
        ],
      ),
    );
  }
}
