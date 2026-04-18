import 'package:shared_preferences/shared_preferences.dart';

class SessionService {
  static late SharedPreferences _prefs;

  static const String _isLoggedInKey = "is_logged_in";
  static const String _userIdKey = "user_id";
  static const String _familyIdKey = "family_id";
  static const String _nameKey = "name";
  static const String _mobileNumberKey = "mobile";
  static const String _profilePicKey = "profile_pic";

  /// 🔥 Call this once at app start
  static Future<void> init() async {
    _prefs = await SharedPreferences.getInstance();
  }

  static void saveUser({
    required String userId,
    required String familyId,
    required String name,
    required String mobile,
  }) {
    _prefs.setBool(_isLoggedInKey, true);
    _prefs.setString(_userIdKey, userId);
    _prefs.setString(_familyIdKey, familyId);
    _prefs.setString(_nameKey, name);
    _prefs.setString(_mobileNumberKey, mobile);
  }

  static bool isLoggedIn() {
    return _prefs.getBool(_isLoggedInKey) ?? false;
  }

  static String getUserId() {
    return _prefs.getString(_userIdKey) ?? "";
  }

  static String getFamilyId() {
    return _prefs.getString(_familyIdKey) ?? "";
  }

  static String getName() {
    return _prefs.getString(_nameKey) ?? "";
  }

  static String getMobileNumber() {
    return _prefs.getString(_mobileNumberKey) ?? "";
  }

  static String getProfilePic() {
    return _prefs.getString(_profilePicKey) ?? "";
  }

  static void saveProfilePic(String url) {
    _prefs.setString(_profilePicKey, url);
  }

  static void logout() {
    _prefs.clear();
  }
}
