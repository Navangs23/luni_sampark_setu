import 'package:flutter/foundation.dart';
import 'dart:convert';
import 'package:firebase_core/firebase_core.dart';
import 'package:firebase_messaging/firebase_messaging.dart';
import 'package:flutter/material.dart';
import 'package:flutter_local_notifications/flutter_local_notifications.dart';
import 'package:luni_sampark_setu/core/services/navigation_service.dart';
import 'package:luni_sampark_setu/ui/home/advertisements/advertisements_view.dart';
import 'package:luni_sampark_setu/ui/home/downloads/downloads_view.dart';
import 'package:luni_sampark_setu/ui/home/gallery/gallery_view.dart';
import 'package:luni_sampark_setu/ui/home/live%20stream/livestream_view.dart';
import 'package:luni_sampark_setu/core/services/notification_api_service.dart';
import 'package:luni_sampark_setu/core/services/session_service.dart';
import 'package:luni_sampark_setu/ui/home/shell/home_shell_viewmodel.dart';
import 'package:provider/provider.dart';

@pragma('vm:entry-point')
Future<void> _firebaseMessagingBackgroundHandler(RemoteMessage message) async {
  await Firebase.initializeApp();
  debugPrint("Handling a background message: ${message.messageId}");
}

class NotificationService {
  static final FirebaseMessaging _messaging = FirebaseMessaging.instance;
  static final FlutterLocalNotificationsPlugin _localNotifications =
      FlutterLocalNotificationsPlugin();
  
  static bool _isAppReady = false;
  static Map<String, dynamic>? _pendingNotificationData;

  static const AndroidNotificationChannel _channel = AndroidNotificationChannel(
    'high_importance_channel', // id
    'High Importance Notifications', // title
    description:
        'This channel is used for important notifications.', // description
    importance: Importance.max,
  );

  static Future<void> initFirebase() async {
    try {
      await Firebase.initializeApp(
        options: const FirebaseOptions(
          apiKey: "AIzaSyDWp6rPFVWPu_OpdBtRcVy240YB06inhHk",
          appId: "1:362541033092:android:33ae739a5adb7e0eb284d1",
          messagingSenderId: "362541033092",
          projectId: "luni-f37ce",
        ),
      );
      FirebaseMessaging.onBackgroundMessage(_firebaseMessagingBackgroundHandler);
    } catch (e) {
      debugPrint("Firebase initialization failed: $e");
    }
  }

  static Future<void> init() async {
    try {
      // 1. Request Permission
      NotificationSettings settings = await _messaging.requestPermission(
        alert: true,
        badge: true,
        sound: true,
      );

      if (settings.authorizationStatus == AuthorizationStatus.authorized) {
        debugPrint('User granted Firebase messaging permission');
      }

      // 2. Request Local Notification Permissions (Android 13+ & iOS)
      if (defaultTargetPlatform == TargetPlatform.android) {
        await _localNotifications
            .resolvePlatformSpecificImplementation<
              AndroidFlutterLocalNotificationsPlugin
            >()
            ?.requestNotificationsPermission();
      } else if (defaultTargetPlatform == TargetPlatform.iOS) {
        await _localNotifications
            .resolvePlatformSpecificImplementation<
              IOSFlutterLocalNotificationsPlugin
            >()
            ?.requestPermissions(alert: true, badge: true, sound: true);
      }

      // 3. Initialize Local Notifications
      const AndroidInitializationSettings initializationSettingsAndroid =
          AndroidInitializationSettings('@mipmap/ic_launcher');
      const InitializationSettings initializationSettings =
          InitializationSettings(android: initializationSettingsAndroid);

      await _localNotifications.initialize(
        initializationSettings,
        onDidReceiveNotificationResponse: (NotificationResponse response) {
          if (response.payload != null) {
            final data = json.decode(response.payload!) as Map<String, dynamic>;
            _handleMessageNavigation(data);
          }
        },
      );

      // 4. Create Android Notification Channel
      await _localNotifications
          .resolvePlatformSpecificImplementation<
            AndroidFlutterLocalNotificationsPlugin
          >()
          ?.createNotificationChannel(_channel);

      // 5. Enable Foreground Notifications Presentation (iOS mostly)
      await _messaging.setForegroundNotificationPresentationOptions(
        alert: true,
        badge: true,
        sound: true,
      );

      // 6. Subscribe to "all" topic
      try {
        await _messaging.subscribeToTopic('all');
      } catch (e) {
        debugPrint('Failed to subscribe: $e');
      }

      // 7. Listeners
      FirebaseMessaging.onMessage.listen((RemoteMessage message) {
        debugPrint(
          "Foreground message received: ${message.notification?.title}",
        );

        // Show local notification for foreground message
        RemoteNotification? notification = message.notification;
        AndroidNotification? android = message.notification?.android;

        if (notification != null && android != null) {
          _localNotifications.show(
            notification.hashCode,
            notification.title,
            notification.body,
            NotificationDetails(
              android: AndroidNotificationDetails(
                _channel.id,
                _channel.name,
                channelDescription: _channel.description,
                icon: android.smallIcon ?? '@mipmap/ic_launcher',
                importance: Importance.max,
                priority: Priority.high,
              ),
            ),
            payload: json.encode(message.data),
          );
        }

        // Auto-refresh unread count
        final context = NavigationService.navigatorKey.currentContext;
        context?.read<HomeShellViewModel>().fetchUnreadCount();
      });

      FirebaseMessaging.onMessageOpenedApp.listen((RemoteMessage message) {
        _handleMessageNavigation(message.data);
      });

      // 8. Initial Message Check (FCM)
      RemoteMessage? initialMessage = await _messaging.getInitialMessage();
      if (initialMessage != null) {
        _handleMessageNavigation(initialMessage.data);
      }

      // 9. Initial Message Check (Local Notifications)
      final NotificationAppLaunchDetails? notificationAppLaunchDetails =
          await _localNotifications.getNotificationAppLaunchDetails();
      if (notificationAppLaunchDetails != null &&
          notificationAppLaunchDetails.didNotificationLaunchApp) {
        final payload =
            notificationAppLaunchDetails.notificationResponse?.payload;
        if (payload != null) {
          final data = json.decode(payload) as Map<String, dynamic>;
          _handleMessageNavigation(data);
        }
      }
    } catch (e, stack) {
      debugPrint("NotificationService init error: $e");
      debugPrint(stack.toString());
    }
  }

  static void _handleMessageNavigation(Map<String, dynamic> data) {
    handleInternalNavigation(data);
  }

  static void setAppReady() {
    debugPrint("NotificationService: App IS READY for navigation");
    _isAppReady = true;
    if (_pendingNotificationData != null) {
      debugPrint("Processing pending notification...");
      final data = _pendingNotificationData!;
      _pendingNotificationData = null;
      handleInternalNavigation(data);
    }
  }

  static Future<void> handleInternalNavigation(
    Map<String, dynamic> data,
  ) async {
    if (!_isAppReady) {
      debugPrint("App not ready yet, queuing notification: $data");
      _pendingNotificationData = data;
      return;
    }

    debugPrint("--- Notification Navigation Debug ---");
    debugPrint("Full Payload: $data");
    
    final String? type = data['type'];
    // Try multiple possible keys for the notification record ID
    final String? notificationId = data['notification_id']?.toString() ?? 
                                   data['id']?.toString() ??
                                   data['notificationId']?.toString() ??
                                   data['type_id']?.toString();
    
    debugPrint("Extracted type: $type");
    debugPrint("Extracted notificationId: $notificationId");
    
    final context = NavigationService.navigatorKey.currentContext;
    debugPrint("Context available: ${context != null}");

    // Mark as read and refresh count
    if (notificationId != null && notificationId.isNotEmpty) {
      final userId = SessionService.getUserId();
      debugPrint("UserId for markAsRead: '$userId'");
      if (userId.isNotEmpty) {
        debugPrint("Marking notification as read: $notificationId");
        await NotificationApiService.markAsRead(userId, notificationId);

        // Force refresh the unread count in the shell
        if (context != null) {
          try {
            Provider.of<HomeShellViewModel>(
              context,
              listen: false,
            ).fetchUnreadCount();
            debugPrint("Shell count refresh triggered");
          } catch (e) {
            debugPrint("Failed to refresh shell count via context: $e");
          }
        }
      }
    }

    if (type == null) {
      debugPrint("No notification type provided, skipping navigation.");
      return;
    }

    switch (type) {
      case 'photo_gallery':
      case 'gallery':
      case 'photo':
        debugPrint("Navigating to GalleryView");
        NavigationService.push(const GalleryView());
        break;
      case 'ads':
        debugPrint("Navigating to AdvertisementsView");
        NavigationService.push(const AdvertisementsView());
        break;
      case 'live_stream':
      case 'live':
        debugPrint("Navigating to LiveStreamView");
        NavigationService.push(const LiveStreamView());
        break;
      case 'downloads':
        debugPrint("Navigating to DownloadsView");
        NavigationService.push(const DownloadsView());
        break;
      case 'news':
      case 'event':
        debugPrint("Navigating to News/Events (Home Tab 0)");
        if (context != null) {
          Provider.of<HomeShellViewModel>(context, listen: false).setIndex(0);
        }
        NavigationService.navigatorKey.currentState?.popUntil(
          (route) => route.isFirst,
        );
        break;
      default:
        debugPrint("Unhandled notification type: $type");
    }
  }

  /// Marks all notifications of specific types as read.
  /// Used when opening a category view (e.g., GalleryView) to clear all relevant notifications.
  static Future<void> markNotificationsByTypeAsRead(List<String> types) async {
    final userId = SessionService.getUserId();
    if (userId.isEmpty) return;

    try {
      debugPrint("Checking for unread notifications to mark as read for types: $types");
      final unread = await NotificationApiService.getUnreadNotifications(userId);
      
      final toMark = unread.where((n) {
        // Match against provided types (case-insensitive)
        final nType = n.type.toLowerCase();
        return types.any((t) => t.toLowerCase() == nType);
      }).toList();

      if (toMark.isNotEmpty) {
        debugPrint("Found ${toMark.length} notifications to mark as read.");
        
        // Execute markAsRead for all in parallel
        await Future.wait(
          toMark.map((n) => NotificationApiService.markAsRead(userId, n.id))
        );

        // Refresh the unread count in the shell badge
        final context = NavigationService.navigatorKey.currentContext;
        if (context != null) {
          try {
            Provider.of<HomeShellViewModel>(context, listen: false).fetchUnreadCount();
            debugPrint("Shell count refresh triggered after category mark-as-read");
          } catch (e) {
            debugPrint("Could not refresh shell count: $e");
          }
        }
      } else {
        debugPrint("No notifications found for categories: $types");
      }
    } catch (e) {
      debugPrint("Error in markNotificationsByTypeAsRead: $e");
    }
  }
}
