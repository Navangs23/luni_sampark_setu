class DirectoryMember {
  final String id;
  final String firstName;
  final String middleName;
  final String grandfatherName;
  final String lastName;
  final String gender;
  final String mobileNo;
  final String photo;

  DirectoryMember({
    required this.id,
    required this.firstName,
    required this.middleName,
    required this.grandfatherName,
    required this.lastName,
    required this.gender,
    required this.mobileNo,
    required this.photo,
  });

  String get fullName => "$firstName $middleName $grandfatherName $lastName".replaceAll(RegExp(r'\s+'), ' ').trim();

  factory DirectoryMember.fromJson(Map<String, dynamic> json) {
    return DirectoryMember(
      id: json['id'] ?? '',
      firstName: json['firstname'] ?? '',
      middleName: json['middlename'] ?? '',
      grandfatherName: json['grandfathername'] ?? '',
      lastName: json['lastname'] ?? '',
      gender: json['gender'] ?? '',
      mobileNo: json['mobileno'] ?? '',
      photo: json['photo'] ?? '',
    );
  }
}
