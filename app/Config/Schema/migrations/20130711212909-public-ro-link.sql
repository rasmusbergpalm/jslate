alter table dashboards add column public_id char(40) not null;
update dashboards set public_id = SHA1(RAND());
create index public_id ON dashboards (public_id);