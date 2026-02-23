class Member {
  final String id;
  final String name;
  final String relation;
  final String backcolor;
  final String image;

  Member({
    required this.id,
    required this.name,
    required this.relation,
    required this.backcolor,
    required this.image,
  });

  factory Member.fromJson(Map<String, dynamic> json) {
    return Member(
      id: json['id'],
      name: json['name'],
      relation: json['relation'],
      backcolor: json['backcolor'],
      image: json['image'],
    );
  }
}
