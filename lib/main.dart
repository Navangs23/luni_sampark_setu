import 'package:flutter/material.dart';
import 'package:luni_sampark_setu/core/services/navigation_service.dart';
import 'package:luni_sampark_setu/core/services/snackbar_service.dart';
import 'package:luni_sampark_setu/ui/home/news/news_events_viewmodel.dart';
import 'package:luni_sampark_setu/ui/home/shell/home_shell_viewmodel.dart';
import 'package:luni_sampark_setu/ui/home/notifications/notifications_viewmodel.dart';
import 'package:provider/provider.dart';

import 'core/services/session_service.dart';
import 'core/theme/app_theme.dart';
import 'ui/home/dashboard/home_viewmodel.dart';
import 'ui/login/login_viewmodel.dart';

// Views
import 'ui/splash/splash_view.dart';

// ViewModels
import 'ui/splash/splash_viewmodel.dart';


Future<void> main() async {
  WidgetsFlutterBinding.ensureInitialized();
  
  await SessionService.init();

  runApp(const MyApp());
}

class MyApp extends StatelessWidget {
  const MyApp({super.key});

  @override
  Widget build(BuildContext context) {
    return MultiProvider(
      providers: [
        ChangeNotifierProvider(create: (_) => SplashViewModel()),
        ChangeNotifierProvider(create: (_) => LoginViewModel()),
        ChangeNotifierProvider(create: (_) => HomeViewModel()),
        ChangeNotifierProvider(create: (_) => NewsEventsViewModel()),
        ChangeNotifierProvider(create: (_) => HomeShellViewModel()),
        ChangeNotifierProvider(create: (_) => NotificationsViewModel()),
      ],
      child: MaterialApp(
        navigatorKey: NavigationService.navigatorKey,
        scaffoldMessengerKey: SnackbarService.messengerKey,
        debugShowCheckedModeBanner: false,
        title: 'Luni Sampark Setu',
        theme: AppTheme.lightTheme,
        /*darkTheme: AppTheme.darkTheme,*/
        themeMode: ThemeMode.system,

        home: const SplashView(),
        builder: (context, child) {
          final mediaQuery = MediaQuery.of(context);
          return MediaQuery(
            data: mediaQuery.copyWith(
              textScaler: const TextScaler.linear(1.0), // fixed size
            ),
            child: child!,
          );
        },
      ),
    );
  }
}
