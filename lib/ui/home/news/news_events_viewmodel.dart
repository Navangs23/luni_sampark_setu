import 'package:flutter/material.dart';

import 'news_event_item.dart';

class NewsEventsViewModel extends ChangeNotifier {
  final List<NewsEventItem> _baseEvents = [
    NewsEventItem(
      title: 'Annual Community Meet',
      description:
          'Join us for the annual community gathering and connect with members.',
      date: DateTime(2025, 1, 15),
      icon: Icons.groups,
      imageUrl: 'https://picsum.photos/300/300?1',
    ),
    NewsEventItem(
      title: 'Blood Donation Camp',
      description: 'Participate in our blood donation drive and save lives.',
      date: DateTime(2025, 2, 10),
      icon: Icons.bloodtype,
      imageUrl: 'https://picsum.photos/300/300?2',
    ),
    NewsEventItem(
      title: 'Festival Celebration',
      description: 'Celebrate the festival together with joy and unity. Celebrate the festival together with joy and unity. Celebrate the festival together with joy and unity. Celebrate the festival together with joy and unity. Celebrate the festival together with joy and unity. Celebrate the festival together with joy and unity. Celebrate the festival together with joy and unity. Celebrate the festival together with joy and unity. Celebrate the festival together with joy and unity.',
      date: DateTime(2025, 3, 5),
      icon: Icons.celebration,
      imageUrl: 'https://picsum.photos/300/300?3',
    ),
  ];

  List<NewsEventItem> generateNewsEvents(int count) {
    return List.generate(count, (index) {
      final base = _baseEvents[index % _baseEvents.length];

      return NewsEventItem(
        title: base.title,
        description: base.description,
        icon: base.icon,
        imageUrl: 'https://picsum.photos/300/300?random=$index',
        date: base.date.add(Duration(days: index)),
      );
    });
  }

  late final List<NewsEventItem> _items;

  NewsEventsViewModel({int count = 20}) {
    _items = generateNewsEvents(count);
  }

  List<NewsEventItem> get items => List.unmodifiable(_items);
}
