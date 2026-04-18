import 'package:flutter/material.dart';
import 'package:luni_sampark_setu/core/services/navigation_service.dart';
import 'package:luni_sampark_setu/core/services/session_service.dart';
import 'package:luni_sampark_setu/ui/home/Community%20Sample/community_sample.dart';

import '../advertisements/advertisements_view.dart';
import '../downloads/downloads_view.dart';
import '../gallery/gallery_view.dart';
import '../live stream/livestream_view.dart';
import '../directory/directory_view.dart';

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
          const CommunitySample(
            pageTitle: "LUNI Committee",
            url: "https://panjoluni.com/mobile-app/pgLuniCommunity.php",
          ),
        );
      },
    ),
    HomeItem(
      title: 'Directory',
      icon: Icons.contact_phone_rounded,
      onTap: () {
        NavigationService.push(const DirectoryView());
      },
    ),
    HomeItem(
      title: 'Sadharmik Seva',
      icon: Icons.volunteer_activism_rounded,
      onTap: () {
        NavigationService.push(
          const CommunitySample(
            pageTitle: "Sadharmik Seva",
            url: "https://panjoluni.com/mobile-app/pgSadharmikSeva.php",
          ),
        );
      },
    ),
    HomeItem(
      title: 'About LUNI',
      icon: Icons.info_outline_rounded,
      onTap: () {
        NavigationService.push(
          const CommunitySample(
            pageTitle: "About LUNI",
            url: "https://panjoluni.com/mobile-app/pgAboutLuni.php",
          ),
        );
      },
    ),
    /*HomeItem(
      title: 'About LUNI App',
      icon: Icons.app_settings_alt_rounded,
      onTap: () {
        NavigationService.push(
          const CommunitySample(
            pageTitle: "About LUNI App",
            url: "https://flutter.dev",
          ),
        );
      },
    ),*/
    HomeItem(
      title: 'Photo Gallery',
      icon: Icons.photo_library_rounded,
      onTap: () {
        NavigationService.push(const GalleryView());
      },
    ),
    HomeItem(
      title: 'Advertisements',
      icon: Icons.campaign_rounded,
      onTap: () {
        NavigationService.push(const AdvertisementsView());
      },
    ),
    HomeItem(
      title: 'Downloads',
      icon: Icons.download_rounded,
      onTap: () {
        NavigationService.push(const DownloadsView());
      },
    ),
    HomeItem(
      title: 'Govt. Important Numbers',
      icon: Icons.local_police_rounded,
      onTap: () {
        NavigationService.push(
          const CommunitySample(
            pageTitle: "Govt. Important Numbers",
            url:
                "https://panjoluni.com/mobile-app/pgImportantGovermentNumber.php",
          ),
        );
      },
    ),
    HomeItem(
      title: 'Live Stream',
      icon: Icons.live_tv_rounded,
      onTap: () {
        NavigationService.push(const LiveStreamView());
      },
    ),

    /*HomeItem(
      title: 'Google Calendar Sync',
      icon: Icons.calendar_month_rounded,
      onTap: () {
        NavigationService.push(
          const CommunitySample(
            pageTitle: "Google Calendar Sync",
            url: "https://flutter.dev",
          ),
        );
      },
    ),*/
  ];
}
