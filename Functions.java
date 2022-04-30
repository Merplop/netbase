public class Functions {
	public boolean emptyInputSignup(String name, String email, String uid, String password, String passwordConf) {
		if (name == null || email == null || uid == null || password == null || passwordConf == null) {
			return true;
		}
		return false;
	}

	public boolean invalidUid(String uid) {
		for (int i = 0; i < uid.length(); i++) {
			if ((uid.charAt(i) >= 0 && uid.charAt(i) < 48) || (uid.charAt(i) > 57 && uid.charAt(i) < 65) || (uid.charAt(i) > 90 || uid.charAt(i) < 97) || (uid.charAt(i) > 122)) {
				return true;
			}
		}
		return false;
	}
}
