# 设计指纹 - Onya Magazine (The Fox Theme)

## 截图观察要点
- 顶部深色条（#191919）带日期显示
- 主 header 白色背景，Logo 居中，两侧有搜索图标和社交图标
- 导航栏在 header 下方独立一条，浅背景，带下划线 hover 效果
- 首页内容：每个分类形成一个区块，左侧大图文+右侧列表组合
- 文章卡片：图上文下，分类标签红色高亮，Oswald 字体标题
- Footer：4列，深色背景，带分隔线和小标题
- 整体调性：杂志风格，清晰层次，红色点缀

## 配色
- 主色：#db4a37（按钮、高亮、链接、分类 badge）
- 辅色/强调色：#b03828（hover 状态）
- 背景色：#ffffff（页面主背景）
- 内容区背景：#f8f8f8（浅灰次级背景）
- 文字色：#000000（正文）
- 标题色：#000000
- 链接色：#db4a37 / 链接 hover 色：#b03828
- 分隔线/边框色：#e0e0e0
- Topbar 背景：#191919

## 字体
- 标题字体族：Oswald（700）
- 正文字体族：Merriweather（300, 400, 700）
- 导航字体族：Oswald
- 字体来源：Google Fonts
- 正文字号参考：16px
- 行高参考：1.7

## HTML DOM 骨架（写 Blade 前完成；只记结构模式，不抄 WP 类名）
- layout（对照 index.html body 顶层）：`div#wi-all.fox-outer-wrapper` 包裹全部内容；桌面头部 `.masthead.header-desktop` 含三段（topbar56 → main_header56 → nav56）；独立移动头部 `#header-mobile` sticky；spacer div；`#wi-main.wi-main` 主内容；`footer#wi-footer.site-footer`
- 首页 content 区：`.builder56.sectionlist` → 多个 `.section56.builder56__section`，每段 `.container.container--main` → `.widget56__row` → `.row` → cols
- 分类页 content 区：`.archive56__titlebar`（H1+面包屑）+ `.archive56__main > .container.container--main` → `.blog56.blog56--grid--4cols`
- 文章页 content 区：`.single-placement > .container.container--single > article.single56.no-sidebar`（header/body/faq/related/popular）

## 模块取舍（对照 source 三页）
- 顶栏/导航：有；三段式（topbar + header + nav）；导航在独立 nav 元素内
- Hero / 焦点头条区：无独立 hero；首页第一个分类区块的特大文章作为视觉焦点
- 首页文章列表形态：按分类分区，每区一大一列混排
- 首页分类聚合区块：有；按 `$blogs` groupBy category 渲染
- 侧边栏（列表/详情）：无独立侧边栏；文章页无侧边栏（no-sidebar）
- Footer：有；4列，深色背景

## 交互取舍（仅 source 出现）
- 移动菜单：有；汉堡按钮（左上）→ overlay 全屏展开；click 触发
- 返回顶部：无
- 搜索交互：无（source 有但略去实现）
- 分类页分页：AJAX 加载（数字分页 + JS fetch）

## 类名与资源路径模式
- source 典型 class/id 模式：`post56`、`blog56`、`meta56`、`title56`、`thumbnail56`、`section56`、`single56` 等——数字后缀+语义前缀体系
- 禁止使用的自造模式：`theme-*`、`site-*`、`{slug}-*` 等统一前缀
- source CSS 路径样例：`css56/common.css`、`css56/header-above.css`、`css56/footer.css`（路径出自 `link` 标签）
- source JS 路径样例：`js56/main.js`
- 产出路径：`public/css56/`、`public/js56/`（镜像 source 组织方式）

## 版式骨架
### 首页
- 整体布局：分类聚合（每分类：大图文 + 列表）
- Header：白色；顶部有黑色 topbar；navBar 粘性
- Hero 区：无独立 hero
- 文章卡片排列：首篇大图上文下；其余列表图右文左
- 各板块分区：topbar → header → nav → 各分类区块 → latestBlogs 区 → footer
- Footer：4列深色

### 分类列表页
- 布局：无侧边栏，4列网格
- 文章卡片样式：图上文下，category badge，Oswald 标题
- 侧边栏内容：无

### 文章详情页
- 主内容区宽度：窄栏阅读（narrow）
- 侧边栏：无（no-sidebar）
- 正文排版特征：Merriweather 正文，宽松行距
- 文章头部信息：category badge → H1 → 作者/日期/分类 meta
- FAQ 区域：有；平铺问答（H2 标题 + H3 问题）
- 相关文章区：有；3列卡片，无 H 标签

## 卡片风格
- 圆角：小（2-4px），参考值：`border-radius: 2px`
- 阴影：无/浅 `box-shadow: 0 1px 3px rgba(0,0,0,.08)`
- 边框：细线 #e0e0e0
- 图片比例：4:3 / 3:2（混用）
- Hover 效果：标题 hover 变红；图片轻微放大（scale 1.03）

## 导航风格
- 位置：顶部；navBar sticky
- 背景：白色
- Logo 位置：居中（桌面）；居中（移动）
- 下拉菜单：无
- 移动端折叠方式：汉堡菜单 → 全屏 overlay

## 调性关键词
杂志感 / 清新简洁 / 红色点缀

## 特殊视觉细节
- 分类 badge：红色实心圆角 pill（#db4a37 白字）
- 文章分隔线：`.post56__sep__line` 细灰线
- 区块分隔线：`.blog56__sep__line` 较深灰线
- topbar 黑色带反差，页面整体白底
- 导航下划线 hover（`nav--active-bar-top` 样式）

---

## 静态资源命名方案
- 标识符：fox56（源自 source theme fox + 56 后缀）
- 样式文件路径清单：
  - `public/css56/common.css` → 变量、reset、基础排版、通用组件
  - `public/css56/header.css` → 桌面/移动 header、nav、mobile overlay
  - `public/css56/grid.css` → blog56 grid、post56 card、section56 布局
  - `public/css56/footer.css` → footer、分页
- 脚本文件路径清单：
  - `public/js56/main.js` → 移动导航 toggle、分类页 AJAX 分页
- CSS 类名风格：数字后缀+语义前缀（`post56`、`meta56`、`blog56__grid--4cols`）
- Partial 文件命名风格示例：`article-list`、`article-card`、`breadcrumb`、`pagination`

## 版式决策
- Hero 区：无独立 hero
- 文章卡片：首篇竖排（图上文下），其余横排（图右文左）
- 分类页侧边栏：无
- 分页方式：数字 AJAX（data-page 属性 + fetch）
- 首页分区：按 $blogs groupBy 分类 + $latestBlogs 最新区块

---

## 自检结果

- [x] _FINGERPRINT.md 已生成，含完整指纹与资源命名方案
- [x] 每个页面有且只有一个 H1
- [x] H 标签层级无跳跃（H1→H2→H3，无 H4+）
- [x] FAQ 区域仅在有数据时渲染，FAQ 区块标题使用 H2，每条问题使用 H3
- [x] 面包屑最后一项无 <a> 标签（不可点击）
- [x] 面包屑字段用的是 $crumb['absolute_url']，不是 $crumb['url']
- [x] 所有 <img> 均有非空 alt 属性（优先用 head_img_alt，降级用 title）
- [x] 文章详情页未渲染 $blog->head_img
- [x] 无任何 penci-* / wp-block-* / magcat-* 类名
- [x] 面包屑 HTML 中无 itemprop / itemscope / itemtype 属性
- [x] 无 javascript:void(0) 链接
- [x] 无 <a> 标签嵌套
- [x] 移动端导航通过 click 而非 hover 触发
- [x] CSS 类名命名体系全文一致（post56/meta56/blog56 体系）
- [x] 资源引用使用 asset() 函数，无硬编码路径
- [x] Blade 注释使用 {{-- --}}，无 HTML 注释
- [x] partials/article-list.blade.php 存在（供 AJAX 调用）
- [x] 分页链接为真实 URL（?page=N）
- [x] JSON-LD 覆盖：首页 WebSite、分类 CollectionPage+BreadcrumbList、文章 Article+BreadcrumbList；FAQPage 仅在 $blog->faq 非空时输出
- [x] <html lang> 使用 app()->getLocale()
- [x] $alternate_tag 在 <head> 中输出
- [x] 产出风格与 source 指纹匹配；已记录截图观察要点
- [x] DOM：指纹含「HTML DOM 骨架」；layout/各页 content 嵌套对齐 source
- [x] 类名：延续 source 命名模式（post56 体系），无自造 slug-* 前缀
- [x] 资源路径：CSS/JS 路径对照 source link/script（css56/、js56/）
- [x] 反模板库：no-sidebar 文章页、无独立 hero、分类聚合区块、fox56 命名体系
