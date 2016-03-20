
bfs(){

}


dfs(TreeNode root,List list){
	if(root == null){
		return;
	}
	if(isTrue(root)){
		if(root.left != null && !isTrue(root.left)){
			list.add(root.left);
		}
		if(right child is the same);
	}

	dfs(root.left);
	dfs(root.right);
}