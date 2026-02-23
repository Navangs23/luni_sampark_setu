import 'package:flutter/material.dart';
import 'package:luni_sampark_setu/core/services/navigation_service.dart';
import 'package:luni_sampark_setu/core/services/session_service.dart';
import 'package:luni_sampark_setu/ui/home/Community%20Sample/community_sample.dart';

class HomeItem {
  final String title;
  final IconData icon;
  final VoidCallback onTap;

  HomeItem({required this.title, required this.icon, required this.onTap});
}

class HomeViewModel extends ChangeNotifier {
  //final String userName =  SessionService.getName();

  List<HomeItem> get items => [
    HomeItem(
      title: 'LUNI Committee',
      icon: Icons.groups_rounded,
      onTap: () {
        NavigationService.push(
          const CommunitySample(pageTitle: "LUNI Committee"),
        );
      },
    ),
    HomeItem(
      title: 'Past Presidents',
      icon: Icons.history_edu_rounded,
      onTap: () {
        NavigationService.push(
          const CommunitySample(pageTitle: "Past Presidents"),
        );
      },
    ),
    HomeItem(
      title: 'Sadharmik Seva',
      icon: Icons.volunteer_activism_rounded,
      onTap: () {
        NavigationService.push(
          const CommunitySample(pageTitle: "Sadharmik Seva"),
        );
      },
    ),
    HomeItem(
      title: 'About LUNI',
      icon: Icons.info_outline_rounded,
      onTap: () {
        NavigationService.push(const CommunitySample(pageTitle: "About LUNI"));
      },
    ),
    HomeItem(
      title: 'About LUNI App',
      icon: Icons.app_settings_alt_rounded,
      onTap: () {
        NavigationService.push(
          const CommunitySample(pageTitle: "About LUNI App"),
        );
      },
    ),
    HomeItem(
      title: 'Photo Gallery',
      icon: Icons.photo_library_rounded,
      onTap: () {
        NavigationService.push(
          const CommunitySample(pageTitle: "Photo Gallery"),
        );
      },
    ),
    HomeItem(
      title: 'Advertisements',
      icon: Icons.campaign_rounded,
      onTap: () {
        NavigationService.push(
          const CommunitySample(pageTitle: "Advertisements"),
        );
      },
    ),
    HomeItem(
      title: 'Downloads',
      icon: Icons.download_rounded,
      onTap: () {
        NavigationService.push(const CommunitySample(pageTitle: "Downloads"));
      },
    ),
    HomeItem(
      title: 'Govt. Important Numbers',
      icon: Icons.local_police_rounded,
      onTap: () {
        NavigationService.push(
          const CommunitySample(pageTitle: "Govt. Important Numbers"),
        );
      },
    ),
    HomeItem(
      title: 'Live Stream',
      icon: Icons.live_tv_rounded,
      onTap: () {
        NavigationService.push(const CommunitySample(pageTitle: "Live Stream"));
      },
    ),
    HomeItem(
      title: 'Google Calendar Sync',
      icon: Icons.calendar_month_rounded,
      onTap: () {
        NavigationService.push(
          const CommunitySample(pageTitle: "Google Calendar Sync"),
        );
      },
    ),
  ];
}
