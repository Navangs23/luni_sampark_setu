import 'package:flutter/material.dart';

class _HomeItem {
  final String title;
  final IconData icon;
  final VoidCallback onTap;

  _HomeItem(this.title, this.icon, this.onTap);
}

final List<_HomeItem> _homeItems = [
  _HomeItem('Family Details', Icons.family_restroom, () {}),
  _HomeItem('My List', Icons.list_alt, () {}),
  _HomeItem('Sadri Directory', Icons.book, () {}),
  _HomeItem('Notifications', Icons.notifications, () {}),
  _HomeItem('AVJSM Committee', Icons.groups, () {}),
  _HomeItem('Past Presidents', Icons.history, () {}),
  _HomeItem('AVJSM – Sambandh', Icons.favorite, () {}),
  _HomeItem('Sadharmik Seva', Icons.volunteer_activism, () {}),
  _HomeItem('About AVJSM', Icons.info, () {}),
  _HomeItem('About AVJSM App', Icons.apps, () {}),
  _HomeItem('Events', Icons.event, () {}),
  _HomeItem('Photo Gallery', Icons.photo_library, () {}),
];
