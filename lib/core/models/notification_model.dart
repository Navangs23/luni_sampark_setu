class NotificationModel {
  final String id;
  final String title;
  final String body;
  final String type;
  final String? typeId;
  final String createdAt;

  NotificationModel({
    required this.id,
    required this.title,
    required this.body,
    required this.type,
    this.typeId,
    required this.createdAt,
  });

  factory NotificationModel.fromJson(Map<String, dynamic> json) {
    return NotificationModel(
      id: json['id']?.toString() ?? "",
      title: json['title'] ?? "",
      body: json['body'] ?? "",
      type: json['type'] ?? "",
      typeId: json['type_id']?.toString(),
      createdAt: json['created_at'] ?? "",
    );
  }

  Map<String, dynamic> toJson() {
    return {
      'id': id,
      'title': title,
      'body': body,
      'type': type,
      'type_id': typeId,
      'created_at': createdAt,
    };
  }
}
