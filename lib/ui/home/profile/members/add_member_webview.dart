import 'package:flutter/material.dart';
import 'package:flutter_inappwebview/flutter_inappwebview.dart';
import 'package:url_launcher/url_launcher.dart';

class AddMemberWebView extends StatefulWidget {
  final String url;
  final String viewTitle;

  const AddMemberWebView({
    super.key,
    required this.url,
    required this.viewTitle,
  });

  @override
  State<AddMemberWebView> createState() => _AddMemberWebViewState();
}

class _AddMemberWebViewState extends State<AddMemberWebView> {
  InAppWebViewController? _webViewController;
  bool _isLoading = true;

  /// 🔥 Change this to your main domain
  final String allowedDomain = "fairlorry.com";

  Future<void> _handleBack() async {
    if (_webViewController != null &&
        await _webViewController!.canGoBack()) {
      _webViewController!.goBack();
    } else {
      if (mounted) {
        Navigator.of(context).pop();
      }
    }
  }

  /// ✅ Check if URL is normal web URL
  bool _isHttp(Uri uri) {
    return uri.scheme == "http" || uri.scheme == "https";
  }

  /// ✅ Launch externally (Chrome / Apps)
  Future<void> _launchExternal(Uri uri) async {
    if (await canLaunchUrl(uri)) {
      await launchUrl(
        uri,
        mode: LaunchMode.externalApplication,
      );
    } else {
      debugPrint("Could not launch $uri");
    }
  }


  @override
  Widget build(BuildContext context) {
    return PopScope(
      canPop: false,
      onPopInvokedWithResult: (didPop, result) async {
        if (didPop) return;
        await _handleBack();
      },
      child: Scaffold(
        backgroundColor: Colors.white,
        appBar: AppBar(
          title: Text(widget.viewTitle),
          leading: IconButton(
            icon: const Icon(Icons.arrow_back),
            onPressed: _handleBack,
          ),
        ),
        body: Stack(
          children: [
            InAppWebView(
              initialUrlRequest: URLRequest(
                url: WebUri(widget.url),
              ),

              initialSettings: InAppWebViewSettings(
                javaScriptEnabled: true,
                mediaPlaybackRequiresUserGesture: false,
                allowFileAccess: true,
                allowContentAccess: true,
                useShouldOverrideUrlLoading: true,
                transparentBackground: false,
              ),

              /// 🔥 MAIN URL INTERCEPTION LOGIC
              shouldOverrideUrlLoading:
                  (controller, navigationAction) async {
                final uri = navigationAction.request.url;

                if (uri == null) {
                  return NavigationActionPolicy.ALLOW;
                }

                final url = uri.toString();

                // ✅ If not http/https → open externally
                if (!_isHttp(uri)) {
                  await _launchExternal(uri);
                  return NavigationActionPolicy.CANCEL;
                }

                // ✅ If external website → open in Chrome
                if (!uri.host.contains(allowedDomain)) {
                  await _launchExternal(uri);
                  return NavigationActionPolicy.CANCEL;
                }

                return NavigationActionPolicy.ALLOW;
              },

              /// 🔥 EXTRA SAFETY (Android sometimes bypasses override)
              onLoadStart: (controller, uri) async {
                if (uri != null && !_isHttp(uri)) {
                  await _launchExternal(uri);
                  return;
                }
                setState(() => _isLoading = true);
              },

              onLoadStop: (controller, uri) {
                setState(() => _isLoading = false);
              },

              onLoadError: (controller, uri, code, message) {
                setState(() => _isLoading = false);
              },

              onWebViewCreated: (controller) {
                _webViewController = controller;
              },

              onPermissionRequest: (controller, request) async {
                return PermissionResponse(
                  resources: request.resources,
                  action: PermissionResponseAction.GRANT,
                );
              },
            ),

            /// ✅ Loader Overlay
            if (_isLoading)
              const Positioned.fill(
                child: ColoredBox(
                  color: Colors.white,
                  child: Center(
                    child: CircularProgressIndicator(),
                  ),
                ),
              ),
          ],
        ),
      ),
    );
  }
}
