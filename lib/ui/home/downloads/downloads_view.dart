import 'package:flutter/material.dart';
import 'package:intl/intl.dart';
import 'package:url_launcher/url_launcher.dart';

import '../../../core/services/content_api_service.dart';
import '../../../core/services/notification_service.dart';

class DownloadsView extends StatefulWidget {
  const DownloadsView({super.key});

  @override
  State<DownloadsView> createState() => _DownloadsViewState();
}

class _DownloadsViewState extends State<DownloadsView> {
  List<dynamic> items = [];
  bool loading = true;

  @override
  void initState() {
    super.initState();
    loadItems();
    NotificationService.markNotificationsByTypeAsRead(['downloads', 'download']);
  }

  Future<void> loadItems() async {
    final data = await ContentApiService.getContent(
      type: "download",
      apiCaller: "mobile",
    );

    setState(() {
      items = data;
      loading = false;
    });
  }

  String formatDate(String? dateStr) {
    if (dateStr == null || dateStr.isEmpty) return "";
    try {
      final date = DateTime.parse(dateStr);
      return DateFormat('MMM dd, yyyy').format(date);
    } catch (_) {
      return dateStr ?? "";
    }
  }

  Future<void> openLink(String? urlStr) async {
    if (urlStr == null || urlStr.isEmpty) return;

    if (!urlStr.startsWith("http")) {
      urlStr = "https://$urlStr";
    }

    final uri = Uri.parse(urlStr);

    if (await canLaunchUrl(uri)) {
      await launchUrl(uri, mode: LaunchMode.externalApplication);
    }
  }

  Widget buildItem(Map<String, dynamic> item) {
    return Card(
      margin: const EdgeInsets.only(bottom: 12),
      shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(12)),
      child: ListTile(
        leading: const Icon(Icons.download_rounded, color: Colors.blue),
        title: Text(
          item['title'] ?? '',
          style: const TextStyle(fontWeight: FontWeight.w600),
        ),
        subtitle: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            if ((item['description'] ?? '').isNotEmpty)
              Padding(
                padding: const EdgeInsets.only(top: 4),
                child: ExpandableText(item['description']),
              ),
            const SizedBox(height: 4),
            Text(
              formatDate(item['date']),
              style: TextStyle(fontSize: 12, color: Colors.grey.shade600),
            ),
          ],
        ),
        trailing: const Icon(Icons.open_in_new),
        onTap: () => openLink(item['link']),
      ),
    );
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(title: const Text("Downloads")),
      body: loading
          ? const Center(child: CircularProgressIndicator())
          : RefreshIndicator(
              onRefresh: loadItems,
              child: ListView.builder(
                physics: const AlwaysScrollableScrollPhysics(),
                padding: const EdgeInsets.all(16),
                itemCount: items.isEmpty ? 1 : items.length,
                itemBuilder: (context, index) {
                  if (items.isEmpty) {
                    return const Padding(
                      padding: EdgeInsets.only(top: 250),
                      child: Center(
                        child: Text(
                          "No Downloads Available",
                          style: TextStyle(fontSize: 16),
                        ),
                      ),
                    );
                  }

                  final item = items[index];
                  return buildItem(item);
                },
              ),
            ),
    );
  }
}

class ExpandableText extends StatefulWidget {
  final String text;

  const ExpandableText(this.text, {super.key});

  @override
  State<ExpandableText> createState() => _ExpandableTextState();
}

class _ExpandableTextState extends State<ExpandableText> {
  bool expanded = false;

  @override
  Widget build(BuildContext context) {
    final text = widget.text;

    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        Text(
          text,
          maxLines: expanded ? null : 2,
          overflow: expanded ? TextOverflow.visible : TextOverflow.ellipsis,
        ),
        if (text.length > 80)
          GestureDetector(
            onTap: () {
              setState(() {
                expanded = !expanded;
              });
            },
            child: Padding(
              padding: const EdgeInsets.only(top: 2),
              child: Text(
                expanded ? "Read Less" : "Read More",
                style: const TextStyle(
                  color: Colors.blue,
                  fontSize: 12,
                  fontWeight: FontWeight.w600,
                ),
              ),
            ),
          ),
      ],
    );
  }
}
