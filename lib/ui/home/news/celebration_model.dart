class CelebrationModel {
  final String id;
  final String name;
  final String relation;
  final String type; // 'Birthday' or 'Anniversary'
  final String image;

  CelebrationModel({
    required this.id,
    required this.name,
    required this.relation,
    required this.type,
    required this.image,
  });

  factory CelebrationModel.fromJson(Map<String, dynamic> json) {
    return CelebrationModel(
      id: json['id']?.toString() ?? '',
      name: json['name'] ?? '',
      relation: json['relation'] ?? '',
      type: json['type'] ?? '',
      image: json['image'] ?? '',
    );
  }
}
