batchload("BasicData.txt");
load("lsquares");
f(t):=exp(c-((t-m)/s)^2);
g(t):=c-((t-m)/s)^2;
h(t):=exp(c)*s*(erf((t-m)/s)+erf(m/s));


/* Extract increment list \Delta(S)=[s_i-s_{i-1},i=1..len(S)] from a list */
Delta(l):=l-append([0],reverse(rest(reverse(l))))$

/* Collect data for a given country into a single nested list */
getData(Land):=block([u,I,R,D,DI,DR,DD],
  u:Land[infected],
  I:makelist([i+21,u[i]],i,1,length(u)),
  u:Delta(u),
  DI:makelist([i+21,u[i]],i,1,length(u)),
  u:Land[recovered],
  R:makelist([i+21,u[i]],i,1,length(u)),
  u:Delta(u),
  DR:makelist([i+21,u[i]],i,1,length(u)),
  u:Land[dead],
  D:makelist([i+21,u[i]],i,1,length(u)),
  u:Delta(u),
  DD:makelist([i+21,u[i]],i,1,length(u)),
[I,R,D,DI,DR,DD])$

plotData(Land,max):=block([l,I,R,D],
  l:getData(Land), I:l[1], R:l[3], D:l[4],
  plot2d([[discrete, I], [discrete, R], [discrete, D]], [t,0,200], [y,0,max],
  [style, lines],
  [color, red, green, blue])
)$


/* == different Fitting procedures == */
	 
nonCumulatedFitting(Land):=block([G5,G6,G6M],
  G5:sublist(Land,lambda([u],second(u)>10)),
  G6:map(lambda([u],[first(u),float(log(second(u)))]),G5),
  G6M:apply('matrix,G6),
  lsquares_estimates(G6M,[t,y],y=g(t),[c,s,m])
)$

cumulatedFitting(G):=block([G5,G6,G6M],
  G5:sublist(G,lambda([u],second(u)>10^3)),
  G6:map(lambda([u],[first(u),float(log(second(u)))]),G5),
  G6M:apply('matrix,G6),
  lsquares_estimates(G6M,[t,y],y=g(t),[c,s,m])
)$

/* ========== Experimental computations =============== */

l:getData(Germany);
O:l[2]; S:l[5];
est:nonCumulatedFitting(S);
define(f0(t),subst(float(first(est)),f(t)));
define(h0(t),subst(float(first(est)),h(t)));



plot2d([[discrete, S], f0(t)], [t,0,200], [y,0,2*10^4],
  [style, points, lines],
  [color, red, blue]
)$

plot2d([[discrete, O], h0(t)], [t,0,200], [y,0,10^5],
  [style, points, lines],
  [color, red, blue]
)$

plot2d([[discrete, l[1]], [discrete, l[2]]], [t,0,200], [y,0,10^5],
  [style, points, lines],
  [color, red, blue]
)$

/* ====== Cumulated Data for Germany =============== */

G:cumulatedData(Germany);
G:sublist(G,lambda([u],second(u)>10^4));

/* Prepare for input to lsquares_estimates and compute the estimated
parameters */

GM:apply('matrix,G);
est:lsquares_estimates(GM,[t,y],y=f(t),[c,s,m]);

/* Computation hangs up with a Lisp error "Internal Zero Divide". The target
function is to complicated. */

/* Match (t,log(c_t)) with c-s*(t-m)^2 */
H:map(lambda([u],[first(u),float(log(second(u)))]),G);
HM:apply('matrix,H);
est:lsquares_estimates(HM,[t,y],y=g(t),[c,s,m]);

/* compute the estimated function */ 
define(fg(t),subst(float(first(est)),f(t)));

/* Plot the data and the estimated extrapolation in a reasonable interval */

plot2d([[discrete, G], fg(t)], [t,0,200], [y,0,10^5],
  [style, points, lines],
  [color, red, blue]
)$

/* ====== Cumulated Data for other countries =============== */

/* Italy */
G:cumulatedData(Italy);
est:cumulatedFitting(G);
define(f0(t),subst(float(first(est)),f(t)));
plot2d([[discrete, G], f0(t)], [t,0,200], [y,0,2*10^5],
  [style, points, lines],
  [color, red, blue]
)$

/* Spain */
G:cumulatedData(Spain);
est:cumulatedFitting(G);
define(f0(t),subst(float(first(est)),f(t)));
plot2d([[discrete, G], f0(t)], [t,0,200], [y,0,1.2*10^5],
  [style, points, lines],
  [color, red, blue]
)$

/* Austria */
G:cumulatedData(Austria);
est:cumulatedFitting(G);
define(f0(t),subst(float(first(est)),f(t)));
plot2d([[discrete, G], f0(t)], [t,0,200], [y,0,2*10^4],
  [style, points, lines],
  [color, red, blue]
)$

/* ====== A similar Fitting on not cumulated data =============== */

/* Germany */
est:nonCumulatedFitting(Germany);
define(f0(t),subst(float(first(est)),f(t)));
plot2d([[discrete, Germany], f0(t)], [t,0,200], [y,0,15*10^4],
  [style, points, lines],
  [color, red, blue]
)$

/* Italy */
est:nonCumulatedFitting(Italy);
define(f0(t),subst(float(first(est)),f(t)));
plot2d([[discrete, Italy], f0(t)], [t,0,200], [y,0,10^4],
  [style, points, lines],
  [color, red, blue]
)$

/* Spain */
est:nonCumulatedFitting(Spain);
define(f0(t),subst(float(first(est)),f(t)));
plot2d([[discrete, Spain], f0(t)], [t,0,200], [y,0,2*10^4],
  [style, points, lines],
  [color, red, blue]
)$

/* Austria */
est:nonCumulatedFitting(Austria);
define(f0(t),subst(float(first(est)),f(t)));
plot2d([[discrete, Austria], f0(t)], [t,0,200], [y,0,2*10^3],
  [style, points, lines],
  [color, red, blue]
)$

