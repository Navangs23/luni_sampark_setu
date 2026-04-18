import 'package:flutter/material.dart';

class AppTextField extends StatelessWidget {
  final String label;
  final TextInputType keyboardType;
  final ValueChanged<String>? onChanged;
  final bool obscureText;
  final int? maxLength;
  final FocusNode? focusNode;
  final bool readOnly;
  final Widget? suffixIcon;
  final Color? textColor;

  const AppTextField({
    super.key,
    required this.label,
    this.keyboardType = TextInputType.text,
    this.onChanged,
    this.obscureText = false,
    this.maxLength,
    this.focusNode,
    this.readOnly = false,
    this.suffixIcon,
    this.textColor = Colors.black,
  });

  @override
  Widget build(BuildContext context) {
    final theme = Theme.of(context);

    return TextFormField(
      readOnly: readOnly,
      keyboardType: keyboardType,
      obscureText: obscureText,
      enableInteractiveSelection: !readOnly,
      maxLength: maxLength,
      cursorColor: theme.colorScheme.secondary,
      onChanged: onChanged,
      focusNode: focusNode,
      style: TextStyle(color: textColor),
      decoration: InputDecoration(
        labelText: label,
        floatingLabelBehavior: FloatingLabelBehavior.auto,
        filled: false,
        counterText: "",
        suffixIcon: suffixIcon,

        labelStyle: TextStyle(color: theme.colorScheme.secondary),

        floatingLabelStyle: TextStyle(
          color: theme.colorScheme.secondary,
          fontWeight: FontWeight.w600,
        ),

        enabledBorder: OutlineInputBorder(
          borderRadius: BorderRadius.circular(12),
          borderSide: BorderSide(
            color: theme.colorScheme.secondary,
            width: 1.2,
          ),
        ),

        focusedBorder: OutlineInputBorder(
          borderRadius: BorderRadius.circular(12),
          borderSide: BorderSide(
            color: theme.colorScheme.secondary,
            width: 1.5,
          ),
        ),

        disabledBorder: OutlineInputBorder(
          borderRadius: BorderRadius.circular(12),
          borderSide: BorderSide(
            color: theme.colorScheme.secondary.withOpacity(0.5),
            width: 1.2,
          ),
        ),
      ),
    );
  }
}
