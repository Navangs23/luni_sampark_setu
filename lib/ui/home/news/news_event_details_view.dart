import 'dart:convert';
import 'package:flutter/material.dart';
import 'package:flutter_widget_from_html/flutter_widget_from_html.dart';
import 'package:url_launcher/url_launcher.dart';
import 'package:cached_network_image/cached_network_image.dart';
import 'package:photo_view/photo_view.dart';
import '../../../core/services/events_api_service.dart';
import '../../../core/services/snackbar_service.dart';
import 'event_utils.dart';
import 'news_event_item.dart';
import '../../../core/utils/calendar_utils.dart';

class EventDetailsPage extends StatefulWidget {
  final NewsEventItem item;
  const EventDetailsPage({super.key, required this.item});

  @override
  State<EventDetailsPage> createState() => _EventDetailsPageState();
}

class _EventDetailsPageState extends State<EventDetailsPage> {
  final PageController detailsPageController = PageController();
  final ScrollController _scrollController = ScrollController();
  final ValueNotifier<double> _opacityNotifier = ValueNotifier<double>(0.0);
  int currentDetailsImageIndex = 0;

  @override
  void initState() {
    super.initState();
    _scrollController.addListener(_onScroll);
  }

  void _onScroll() {
    // SliverAppBar expandedHeight = 300
    // Collapsed height ~ 60
    // Body title starts after 300.
    // We want the AppBar title to appear only when the body title is scrolling off.
    const fadeStart = 280.0;
    const fadeEnd = 360.0;
    final offset = _scrollController.offset;

    double opacity = 0.0;
    if (offset > fadeStart) {
      opacity = ((offset - fadeStart) / (fadeEnd - fadeStart)).clamp(0.0, 1.0);
    }

    if (opacity != _opacityNotifier.value) {
      _opacityNotifier.value = opacity;
    }
  }

  Future<void> _handleLinkTap(String url) async {
    final cleanUrl = url.trim();
    if (cleanUrl.isEmpty) return;

    try {
      final uri = Uri.parse(
        cleanUrl.startsWith('http') ? cleanUrl : 'https://$cleanUrl',
      );

      await launchUrl(uri, mode: LaunchMode.externalApplication);
    } catch (e) {
      SnackbarService.show(
        "Could not open link: $cleanUrl",
        type: SnackbarType.error,
      );
    }
  }

  @override
  void dispose() {
    detailsPageController.dispose();
    _scrollController.dispose();
    _opacityNotifier.dispose();
    super.dispose();
  }

  void _showFullScreenImage(String imageUrl) {
    showDialog(
      context: context,
      builder: (context) => Dialog.fullscreen(
        backgroundColor: Colors.black,
        child: Stack(
          children: [
            PhotoView(
              imageProvider: CachedNetworkImageProvider(imageUrl),
              minScale: PhotoViewComputedScale.contained,
              maxScale: PhotoViewComputedScale.covered * 2.0,
              backgroundDecoration: const BoxDecoration(color: Colors.black),
            ),
            Positioned(
              top: 40,
              right: 20,
              child: IconButton(
                icon: const Icon(Icons.close, color: Colors.white, size: 30),
                onPressed: () => Navigator.of(context).pop(),
              ),
            ),
          ],
        ),
      ),
    );
  }

  Widget _buildHtmlDescription(String? text, {required Color themeColor}) {
    if (text == null || text.trim().isEmpty) {
      return const Text(
        "No description available.",
        style: TextStyle(color: Colors.grey),
      );
    }

    // 🔥 Convert plain URLs into <a> tags ONLY if not already HTML-rich
    // This avoids breaking existing tags or nesting links.
    String processedText = text;
    if (!text.contains('<a') && !text.contains('</a>')) {
      processedText = text.replaceAllMapped(
        RegExp(r'(?<!["''=])(https?:\/\/[^\s<]+)'),
        (match) {
          final url = match.group(0)!;
          return '<a href="$url">$url</a>';
        },
      );
    }

    return HtmlWidget(
      processedText,
      textStyle: const TextStyle(
        fontSize: 16,
        height: 1.5,
        color: Colors.black87,
      ),
      customStylesBuilder: (element) {
        if (element.localName == 'a') {
          return {
            'color': '#2196F3',
            'text-decoration': 'underline',
            'font-weight': 'bold',
          };
        }
        return null;
      },
      onTapUrl: (url) {
        print("URL Click: $url");
        _handleLinkTap(url);
        return true;
      },
    );
  }

  @override
  Widget build(BuildContext context) {
    final item = widget.item;
    final iconData = EventUtils.getEventIconData(
      "${item.iconName}-${item.category}",
    );

    return Scaffold(
      body: CustomScrollView(
        controller: _scrollController,
        slivers: [
          // ==================== HERO HEADER — FIXED COVER IMAGE ====================
          ValueListenableBuilder<double>(
            valueListenable: _opacityNotifier,
            builder: (context, opacity, child) {
              return SliverAppBar(
                expandedHeight: 300,
                pinned: true,
                backgroundColor: iconData.color.withOpacity(opacity),
                surfaceTintColor: Colors.transparent,
                elevation: 0,
                leading: IconButton(
                  icon: const Icon(Icons.arrow_back, color: Colors.white),
                  onPressed: () => Navigator.of(context).pop(),
                ),
                title: Opacity(
                  opacity: opacity,
                  child: Text(
                    item.title,
                    style: const TextStyle(
                      fontSize: 18,
                      fontWeight: FontWeight.bold,
                      color: Colors.white,
                    ),
                    maxLines: 1,
                    overflow: TextOverflow.ellipsis,
                  ),
                ),
                flexibleSpace: FlexibleSpaceBar(
                  background: Stack(
                    fit: StackFit.expand,
                    children: [
                      Container(color: iconData.color.withOpacity(0.92)),
                      if (item.imageUrl.isNotEmpty)
                        Center(
                          child: Padding(
                            padding: const EdgeInsets.symmetric(
                              horizontal: 40,
                              vertical: 20,
                            ),
                            child: GestureDetector(
                              onTap: () => _showFullScreenImage(item.imageUrl),
                              child: Hero(
                                tag: 'event-cover-${item.title}',
                                child: CachedNetworkImage(
                                  imageUrl: item.imageUrl,
                                  fit: BoxFit.contain,
                                  placeholder: (context, url) => const Center(
                                    child: SizedBox(
                                      width: 40,
                                      height: 40,
                                      child: CircularProgressIndicator(
                                        color: Colors.white,
                                      ),
                                    ),
                                  ),
                                  errorWidget: (context, url, error) =>
                                      const Icon(
                                        Icons.image,
                                        color: Colors.white70,
                                        size: 90,
                                      ),
                                ),
                              ),
                            ),
                          ),
                        ),
                      const Align(
                        alignment: Alignment.bottomCenter,
                        child: SizedBox(
                          height: 100,
                          child: DecoratedBox(
                            decoration: BoxDecoration(
                              gradient: LinearGradient(
                                begin: Alignment.topCenter,
                                end: Alignment.bottomCenter,
                                colors: [Colors.transparent, Colors.black38],
                              ),
                            ),
                          ),
                        ),
                      ),
                    ],
                  ),
                  centerTitle: true,
                ),
              );
            },
          ),

          // ==================== Body Prominent Title ====================
          SliverToBoxAdapter(
            child: Padding(
              padding: const EdgeInsets.fromLTRB(20, 24, 20, 0),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Row(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      Container(
                        padding: const EdgeInsets.all(10),
                        decoration: BoxDecoration(
                          color: iconData.color.withOpacity(0.1),
                          borderRadius: BorderRadius.circular(12),
                        ),
                        child: Icon(
                          iconData.icon,
                          color: iconData.color,
                          size: 28,
                        ),
                      ),
                      const SizedBox(width: 16),
                      Expanded(
                        child: Text(
                          item.title,
                          style: const TextStyle(
                            fontSize: 26,
                            fontWeight: FontWeight.bold,
                            height: 1.2,
                          ),
                        ),
                      ),
                    ],
                  ),
                  const SizedBox(height: 16),
                  Divider(color: Colors.grey.withOpacity(0.2)),
                ],
              ),
            ),
          ),

          // ... rest of the content (date rows etc) ...
          SliverToBoxAdapter(
            child: Padding(
              padding: const EdgeInsets.fromLTRB(16, 20, 16, 8),
              child: Row(
                mainAxisAlignment: MainAxisAlignment.center,
                children: [
                  Container(
                    padding: const EdgeInsets.symmetric(
                      horizontal: 16,
                      vertical: 8,
                    ),
                    decoration: BoxDecoration(
                      color: Colors.grey.shade100,
                      borderRadius: BorderRadius.circular(30),
                    ),
                    child: Row(
                      children: [
                        Icon(
                          Icons.calendar_today,
                          size: 18,
                          color: Colors.grey.shade700,
                        ),
                        const SizedBox(width: 8),
                        Text(
                          EventUtils.formatDate(item.date.toString()),
                          style: const TextStyle(
                            fontSize: 16,
                            fontWeight: FontWeight.w600,
                          ),
                        ),
                      ],
                    ),
                  ),
                  const SizedBox(width: 12),
                  Container(
                    padding: const EdgeInsets.symmetric(
                      horizontal: 16,
                      vertical: 8,
                    ),
                    decoration: BoxDecoration(
                      color: (item.status ?? 'unknown') == 'active'
                          ? Colors.green.withOpacity(0.12)
                          : Colors.red.withOpacity(0.12),
                      borderRadius: BorderRadius.circular(30),
                    ),
                    child: Text(
                      (item.status ?? 'unknown').toUpperCase(),
                      style: TextStyle(
                        color: (item.status ?? 'unknown') == 'active'
                            ? Colors.green
                            : Colors.red,
                        fontWeight: FontWeight.bold,
                        fontSize: 13,
                      ),
                    ),
                  ),
                ],
              ),
            ),
          ),

          SliverToBoxAdapter(
            child: Padding(
              padding: const EdgeInsets.symmetric(horizontal: 16),
              child: OutlinedButton.icon(
                onPressed: () async {
                  final url = CalendarUtils.generateGoogleCalendarUrl(
                    title: item.title,
                    description: item.shortDescription ?? '',
                    date: item.date,
                  );
                  final uri = Uri.parse(url);
                  if (await canLaunchUrl(uri)) {
                    await launchUrl(uri, mode: LaunchMode.externalApplication);
                  }
                },
                icon: const Icon(Icons.event_available),
                label: const Text("Add to Google Calendar"),
                style: OutlinedButton.styleFrom(
                  foregroundColor: iconData.color,
                  side: BorderSide(color: iconData.color),
                  shape: RoundedRectangleBorder(
                    borderRadius: BorderRadius.circular(12),
                  ),
                ),
              ),
            ),
          ),

          SliverToBoxAdapter(
            child: Padding(
              padding: const EdgeInsets.fromLTRB(16, 8, 16, 24),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Text(
                    "Description",
                    style: TextStyle(
                      fontSize: 22,
                      fontWeight: FontWeight.bold,
                      color: iconData.color,
                    ),
                  ),
                  const SizedBox(height: 12),
                  _buildHtmlDescription(
                    item.shortDescription,
                    themeColor: iconData.color,
                  ),
                  const SizedBox(height: 20),
                  _buildHtmlDescription(
                    item.longDescription,
                    themeColor: iconData.color,
                  ),
                ],
              ),
            ),
          ),

          if (item.googlePhotosLink != null &&
              item.googlePhotosLink!.trim().isNotEmpty)
            SliverToBoxAdapter(
              child: Padding(
                padding: const EdgeInsets.fromLTRB(16, 0, 16, 24),
                child: InkWell(
                  onTap: () async {
                    final link = item.googlePhotosLink!.trim();
                    final uri = Uri.parse(
                      link.startsWith('http') ? link : 'https://$link',
                    );
                    if (await canLaunchUrl(uri)) {
                      await launchUrl(
                        uri,
                        mode: LaunchMode.externalApplication,
                      );
                    } else {
                      SnackbarService.show(
                        "Could not launch link",
                        type: SnackbarType.error,
                      );
                    }
                  },
                  child: Container(
                    padding: const EdgeInsets.all(18),
                    decoration: BoxDecoration(
                      color: Colors.blue.withOpacity(0.08),
                      borderRadius: BorderRadius.circular(16),
                      border: Border.all(color: Colors.blue.withOpacity(0.3)),
                    ),
                    child: Row(
                      children: [
                        const Icon(
                          Icons.photo_library,
                          color: Colors.blue,
                          size: 28,
                        ),
                        const SizedBox(width: 16),
                        Expanded(
                          child: Column(
                            crossAxisAlignment: CrossAxisAlignment.start,
                            children: [
                              const Text(
                                "Google Photos Album",
                                style: TextStyle(
                                  fontWeight: FontWeight.bold,
                                  fontSize: 16,
                                ),
                              ),
                              Text(
                                item.googlePhotosLink!,
                                style: const TextStyle(color: Colors.blue),
                                maxLines: 1,
                                overflow: TextOverflow.ellipsis,
                              ),
                            ],
                          ),
                        ),
                        const Icon(
                          Icons.arrow_forward_ios,
                          size: 20,
                          color: Colors.blue,
                        ),
                      ],
                    ),
                  ),
                ),
              ),
            ),

          if (item.eventImages != null && item.eventImages!.isNotEmpty)
            SliverToBoxAdapter(
              child: Builder(
                builder: (context) {
                  List<String> images = [];
                  final jsonStr = item.eventImages;
                  if (jsonStr != null && jsonStr.isNotEmpty) {
                    try {
                      final decoded = jsonDecode(jsonStr);
                      images = (decoded is List)
                          ? decoded.map((e) => e.toString()).toList()
                          : [jsonStr];
                    } catch (_) {
                      images = [jsonStr];
                    }
                  }
                  if (images.isEmpty) return const SizedBox.shrink();

                  return Padding(
                    padding: const EdgeInsets.fromLTRB(16, 0, 16, 40),
                    child: Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: [
                        Text(
                          "Event Images",
                          style: TextStyle(
                            fontSize: 22,
                            fontWeight: FontWeight.bold,
                            color: iconData.color,
                          ),
                        ),
                        const SizedBox(height: 16),
                        Container(
                          height: 340,
                          decoration: BoxDecoration(
                            borderRadius: BorderRadius.circular(20),
                            boxShadow: [
                              BoxShadow(
                                color: Colors.black.withOpacity(0.07),
                                blurRadius: 15,
                              ),
                            ],
                          ),
                          child: ClipRRect(
                            borderRadius: BorderRadius.circular(20),
                            child: Stack(
                              children: [
                                PageView.builder(
                                  controller: detailsPageController,
                                  itemCount: images.length,
                                  onPageChanged: (index) => setState(
                                    () => currentDetailsImageIndex = index,
                                  ),
                                  itemBuilder: (context, i) {
                                    final imageUrl =
                                        "${EventsApiService.eventsImageUrl}${images[i]}";
                                    return GestureDetector(
                                      onTap: () =>
                                          _showFullScreenImage(imageUrl),
                                      child: CachedNetworkImage(
                                        imageUrl: imageUrl,
                                        fit: BoxFit.contain,
                                        placeholder: (context, url) =>
                                            const Center(
                                              child: SizedBox(
                                                width: 34,
                                                height: 34,
                                                child:
                                                    CircularProgressIndicator(
                                                      strokeWidth: 3,
                                                    ),
                                              ),
                                            ),
                                        errorWidget: (context, url, error) =>
                                            const Center(
                                              child: Icon(
                                                Icons.broken_image,
                                                size: 60,
                                              ),
                                            ),
                                      ),
                                    );
                                  },
                                ),
                                if (images.length > 1) ...[
                                  Positioned(
                                    left: 12,
                                    top: 140,
                                    child: _buildNavButton(Icons.chevron_left),
                                  ),
                                  Positioned(
                                    right: 12,
                                    top: 140,
                                    child: _buildNavButton(Icons.chevron_right),
                                  ),
                                ],
                              ],
                            ),
                          ),
                        ),
                        const SizedBox(height: 12),
                        if (images.length > 1)
                          Center(
                            child: Text(
                              "${currentDetailsImageIndex + 1} / ${images.length}",
                              style: TextStyle(
                                color: Colors.grey.shade600,
                                fontWeight: FontWeight.w600,
                              ),
                            ),
                          ),
                      ],
                    ),
                  );
                },
              ),
            ),
        ],
      ),
    );
  }

  Widget _buildNavButton(IconData icon) {
    return CircleAvatar(
      backgroundColor: Colors.black.withOpacity(0.5),
      child: IconButton(
        icon: Icon(icon, color: Colors.white),
        onPressed: () {
          if (icon == Icons.chevron_left) {
            detailsPageController.previousPage(
              duration: const Duration(milliseconds: 300),
              curve: Curves.easeInOut,
            );
          } else {
            detailsPageController.nextPage(
              duration: const Duration(milliseconds: 300),
              curve: Curves.easeInOut,
            );
          }
        },
      ),
    );
  }
}
